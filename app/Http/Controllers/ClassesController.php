<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Level;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Instructor;
use App\Exports\ClassExport;
use App\Imports\ClassImport;
use Illuminate\Http\Request;
use App\Exports\ClassHistory;
use App\Exports\StudentExport;
use App\Imports\ClassHistoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ClassesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view class')->only(['index']);
        $this->middleware('permission:show class')->only(['show']);
        $this->middleware('permission:create class')->only(['create', 'store']);
        $this->middleware('permission:edit class')->only(['update', 'edit']);
        $this->middleware('permission:delete class')->only(['delete']);
    }

    public function index(Request $request)
    {
        $totalClasses = ClassModel::all()->count();

        $query = ClassModel::with('level', 'instructor');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('instructor_name')) {
            $query->whereHas('instructor', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->instructor_name . '%');
            });
        }

        $classes = $query->get();

        return view('classes.index', compact('classes', 'totalClasses'));
    }

    public function create()
    {
        $levels = Level::all();
        $instructors = Instructor::all();
        return view('classes.add', compact('levels', 'instructors'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'days' => 'required|array',
            'level_id' => 'required|exists:levels,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);
        
          $userTimezone = 'Asia/Karachi'; // Your current timezone (Pakistan)
        $kuwaitTimezone = 'Asia/Kuwait'; // Target timezone

        $class = new ClassModel();
        $class->name = $request->name;
        $class->start_time = Carbon::parse($request->start_time, $userTimezone)
            ->setTimezone($kuwaitTimezone)
            ->toTimeString();
        $class->end_time = Carbon::parse($request->end_time, $userTimezone)
            ->setTimezone($kuwaitTimezone)
            ->toTimeString();


        $class->days = $request->days;
        $class->level_id = $request->level_id;
        $class->instructor_id = $request->instructor_id;

        $class->save();

        return redirect()->route('classes.index')->with('success', 'Class added successfully.');
    }

    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        $levels = Level::all();
        $instructors = Instructor::whereHas('levels', function ($query) use ($class) {
            $query->where('level_id', $class->level_id);
        })->get();
        return view('classes.edit', compact('class', 'levels', 'instructors'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'days' => 'required|array',
            'level_id' => 'required|exists:levels,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        $class = ClassModel::findOrFail($id);
        $class->name = $request->name;
        $class->start_time = $request->start_time;
        $class->end_time = $request->end_time;
        $class->days = $request->days;
        $class->level_id = $request->level_id;
        $class->status = $request->status;
        $class->instructor_id = $request->instructor_id;

        $class->save();

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(string $id)
    {
        $class = ClassModel::findOrFail($id);

        if ($class) {
              // Delete the student's payment record
            $student = Student::where('class_model_id', $class->id)->first();
            if ($student) {
                $student->delete();
            }
            $class->delete();
        }
        return redirect()->route('classes.index')->with('danger', 'Class deleted successfully.');
    }

    public function getInstructorsByLevel($levelId)
    {
        // Validate levelId to ensure it is numeric
        if (!is_numeric($levelId)) {
            return response()->json(['error' => 'Invalid level ID'], 400);
        }

        // Fetch instructors associated with the specified level ID
        $instructors = Instructor::whereHas('levels', function ($query) use ($levelId) {
            $query->where('level_id', $levelId);
        })->get();

        // Check if any instructors were found
        if ($instructors->isEmpty()) {
            return response()->json(['message' => 'No instructors found'], 404);
        }

        // Return the instructors as a JSON response
        return response()->json($instructors, 200);
    }

    public function view($id, Request $request)
    {
        $class = ClassModel::findOrFail($id);

        $studentsQuery = $class->students();

        if ($request->filled('search')) {
            $search = $request->search;
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('nationality', 'like', "%{$search}%")
                    ->orWhere('civil_id', 'like', "%{$search}%")
                    ->orWhere('telephone_number', 'like', "%{$search}%")
                    ->orWhere('recipt_number', 'like', "%{$search}%")
                    ->orWhere('registration_id', 'like', "%{$search}%");
            });
        }

        $classModuleId = $request->input('class_module_id');
        if ($classModuleId) {
            $studentsQuery->whereHas('attendances', function ($query) use ($classModuleId) {
                $query->where('class_module_id', $classModuleId)
                    ->where('is_present', true);
            });
        }

        $class->setRelation('students', $studentsQuery->get());

        return view('classes.view', compact('class'));
    }


    public function classExport(Request $request)
    {

        $request->validate([
            'type' => 'required',
        ]);
        if ($request->type === "xlsx") {
            $extension = "xlsx";
        } elseif ($request->type === "csv") {
            $extension = "csv";
        } elseif ($request->type === "tsv") {
            $extension = "tsv";
        } else {
            $extension = "xls";
        }
    
        $filePath = 'exports/classes-' . date('d-m-y') . '.' . $extension;
       
        Excel::store(new ClassExport, $filePath, 'public');
      
        return Storage::disk('public')->download($filePath);
    }


    public function classHistory(Request $request, $classId)
    {
        $request->validate([
            'type' => 'required',
        ]);

        // Determine the file extension
        $extension = strtoupper($request->type);
        $validExtensions = ['xlsx', 'csv', 'tsv'];
        $extension = in_array($extension, $validExtensions) ? $extension : 'xls';

        $filePath = 'exports/classHistory-' . date('d-m-y') . '.' . strtolower($extension);

        // Pass the class ID to the export class
        Excel::store(new ClassHistory($classId), $filePath, 'public');

        return Storage::disk('public')->download($filePath);
    }


    public function classImport(Request $request)
    {

        $request->validate([
            'file_import' => 'required|file|mimes:xlsx,xls,csv,tsv'
        ]);

        $file = $request->file('file_import');
       
        
        Excel::import(new ClassImport, $file);
       
        return back()->with('success', 'Classes Imported successfully.');
    }


   
}
