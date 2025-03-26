<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Level;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Attendence;
use App\Models\ClassModel;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Imports\studentImport;
use App\Models\StudentHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Picqer\Barcode\BarcodeGenerator;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view student')->only(['index']);
        $this->middleware('permission:show student')->only(['show']);
        $this->middleware('permission:create student')->only(['create', 'store']);
        $this->middleware('permission:edit student')->only(['update', 'edit']);
        $this->middleware('permission:delete student')->only(['delete']);
    }

    public function index(Request $request)
    {

        $countStudent = Student::where('is_test', 0)->count();;
        $query = Student::with('classModel', 'payments');
        if ($request->filled('search')) {
            $query->where('address', 'like', '%' . $request->search . '%')
                ->orWhere('id', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('civil_id', 'like', '%' . $request->search . '%')
                ->orWhere('telephone_number', 'like', '%' . $request->search . '%')
                ->orWhere('nationality', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('recipt_number', 'like', '%' . $request->search . '%')
                ->orWhere('registration_id', 'like', '%' . $request->search . '%');
        }
        $students = $query->get();
        return view('students.index', compact('students', 'countStudent'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        return view('students.add', compact('classes'));
    }
    public function store(Request $request)
    {
      
        try {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'gender' => 'required|in:Male,Female',
                    'date_of_birth' => 'required|date|before:today',
                    'joining_date' => 'required|date',
                    'class_start_date' => 'required|date',
                    'class_end_date' => 'required|date',
                    'civil_id' => 'required|string|unique:students,civil_id|max:50',
                    'nationality' => 'required|string|max:100',
                    'address' => 'required|string|max:255',
                    'place_of_birth' => 'required|string|max:100',
                    'telephone_number' => 'required|string',
                    'recipt_number' => 'required|string',
                    'amount' => 'required|numeric|min:0',
                    'class_model_id' => 'required|exists:class_models,id',
                    'image' => 'nullable|image|max:10240',
                ]
            );


            $registrationId = rand(100000000, 999999999);

            $student = new Student();
            

            $student->registration_id = $registrationId;
            $student->name = $request->name;
            $student->gender = $request->gender;
            $student->date_of_birth = $request->date_of_birth;
            $student->civil_id = $request->civil_id;
            $student->nationality = $request->nationality;
            $student->address = $request->address;
            $student->place_of_birth = $request->place_of_birth;
            $student->telephone_number = $request->telephone_number;
            $student->recipt_number = $request->recipt_number;
            $student->joining_date = $request->joining_date;
            $student->class_start_date = $request->class_start_date;
            $student->class_end_date = $request->class_end_date;
            $student->comment = $request->comment;
            $student->is_test = $request->input('is_test', false);

            $student->class_model_id = $request->class_model_id;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $imageName, 'public');

                $student->image = $path;
            } else {

                if (!$student->image) {
                    $student->image = 'images/default.png';
                }
            }

            $student->save();

            // Create payment record

            $payment = new payment();
            $payment->student_id = $student->id;
            $payment->class_model_id = $student->class_model_id;
            $payment->payment_date =  now()->toDateString();
            $payment->payment_time =  now()->toTimeString();
            $payment->amount = $request->amount;
            $payment->save();
        } catch (QueryException $e) {
            // Check if the exception is a duplicate entry
            if ($e->getCode() == 23000) {
                return back()->withErrors(['students_registration_id' => 'The registration ID is already in use. Please choose a unique ID.'])->withinput($request->all());
            }
        }

        return redirect()->route('students.index')->with('success', 'Student Added Successfully!');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassModel::with(['instructor', 'level'])->get();
        $currentClass = ClassModel::find($student->class_model_id);
        return view('students.edit', compact('student', 'classes', 'currentClass'));
    }

    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'date_of_birth' => 'required|date|before:today',
                'class_start_date' => 'required|date',
                'class_end_date' => 'required|date',
                'civil_id' => 'required|string|unique:students,civil_id,' . $id . '|max:50',
                'nationality' => 'required|string|max:100',
                'address' => 'required|string|max:255',
                'place_of_birth' => 'required|string|max:100',
                'telephone_number' => 'required|string',
                'registration_id' => 'required|unique:students,registration_id,' . $student->id,
                'recipt_number' => 'required|string',
                'amount' => 'required|numeric|min:0',
                'image' => 'nullable|image|max:10240',
            ]);

            // Save current student information to history if the class_model_id has changed
            if ($student->class_model_id != $request->class_model_id) {
                $history = new StudentHistory();
                $history->student_id = $student->id;
                $history->previous_class_model_id = $student->class_model_id;
                $history->previous_class_start_date = $student->class_start_date;
                $history->previous_class_end_date = $student->class_end_date;
                $history->transferred_at = now();
                $history->save();
            }
            // Update student details
            $student->name = $request->name;
            $student->gender = $request->gender;
            $student->date_of_birth = $request->date_of_birth;
            $student->civil_id = $request->civil_id;
            $student->nationality = $request->nationality;
            $student->address = $request->address;
            $student->status = $request->status;
            $student->place_of_birth = $request->place_of_birth;
            $student->telephone_number = $request->telephone_number;
            $student->recipt_number = $request->recipt_number;
            $student->class_start_date = $request->class_start_date;
            $student->class_end_date = $request->class_end_date;
            $student->class_model_id = $request->class_model_id;
              $student->comment=$request->comment;
            $student->is_test = $request->input('is_test', false);
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $existingImagePath = storage_path('app/public/' . $student->image);
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $imageName, 'public');
                $student->image = $path;
            } else {
                if (!$student->image) {
                    $student->image = 'images/default.png';
                }
            }
            $student->save();
            // Save payment if student is active
            if ($student->status == 'Active') {
                $payment = new Payment();
                $payment->student_id = $id;
                $payment->class_model_id = $student->class_model_id;
                $payment->payment_date = now()->toDateString();
                $payment->payment_time = now()->toTimeString();
                $payment->amount = $request->amount;
                $payment->save();
            }
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->withErrors([
                    'students_registration_id' => 'The registration ID is already in use. Please choose a unique ID.'
                ])->withInput($request->all());
            }
        }

        if ($student->is_test == '1') {

            return redirect()->route('students.testStudent')->with('success', 'Student Updated Successfully!');
        }
        return redirect()->route('students.index')->with('success', 'Student Updated Successfully!');
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            // Delete the student's payment record
            $payment = Payment::where('student_id', $student->id)->first();

        
            if ($payment) {
                $payment->delete();
            }
            // Delete the student image
            $imagePath = public_path('storage/' . $student->image);
            if (File::exists($imagePath)) {
                file::delete($imagePath);
            }

            // Delete the QR Code image
            $qrCodePath = public_path($student->qr_code);
            if (File::exists($qrCodePath)) {
                File::delete($qrCodePath);
            }

            // Delete the barcode image
            $barcodePath = public_path($student->barcode);
            if (File::exists($barcodePath)) {
                File::delete($barcodePath);
            }

            $student->delete();
        }
        if ($student->is_test == '1') {

            return redirect()->route('students.testStudent')->with('danger', 'Student Deleted Successfully!');
        }
        return redirect()->route('students.index')->with('danger', 'Student Deleted Successfully!');
    }
    
    public function getClassDetails(Request $request)
    {
        $classId = $request->class_model_id;
        $classDetails = ClassModel::with(['instructor', 'level'])->find($classId);

        if ($classDetails) {
            return response()->json([
                'success' => true,
                'instructor' => $classDetails->instructor,
                'level' => $classDetails->level,
                'start_time' => $classDetails->start_time ?? 'N/A',
                'end_time' => $classDetails->end_time ?? 'N/A',
                'day' => $classDetails->days ?? 'N/A',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'No details found for the selected class.',
        ]);
    }

    public function view($id)
    {
        $student = Student::with('histories')->find($id);
        $studentEnrollment = Enrollment::where('student_id', $student->id)->first();
        $class = ClassModel::find($student->class_model_id);
        $level = Level::find($student->level_id);
        $attendence = Attendence::where('student_id', $student->id)->get();

        return view('students.view', compact('student', 'class', 'level', 'attendence', 'studentEnrollment'));
    }

    
    public function printIDCard($id)
    {
        $student = Student::findOrFail($id);
        return view('students.id-card', compact('student'));
    }
    public function downloadEID($id)
    {
        $student = Student::findOrFail($id);
        $imagePath = public_path('assets/images/others/barcode.png');
        if (!file_exists($imagePath)) {
            $imagePath = public_path('storage/images/avatar.png');
        }
        $imageData = base64_encode(file_get_contents($imagePath));
        $base64Image = 'data:image/png;base64,' . $imageData;
        $pdf = Pdf::loadView('students.download-card', compact('base64Image'));
        return $pdf->download('E-ID-' . $student->name . '.pdf');
    }

    public function getClassesByGender(Request $request)
    {
        $gender = $request->query('gender');
        $classes = ClassModel::where('gender', $gender)->get();
        return response()->json($classes);
    }

    public function studentExport(Request $request)
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
        // Define the file path
        $filePath = 'exports/students-' . date('d-m-y') . '.' . $extension;
        // Store the export file
        Excel::store(new StudentExport, $filePath, 'public');
        // Return the file for download
        return Storage::disk('public')->download($filePath);
    }

    public function renew(string $id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassModel::with(['instructor', 'level'])->get();
        $currentClass = ClassModel::find($student->class_model_id);
        return view('students.renew', compact('student', 'classes', 'currentClass'));
    }

    public function testStudent(Request $request)
    {
        $countStudent = Student::where('is_test', 1)->count();
        $query = Student::where('is_test', 1)->with(['classModel', 'payments']);

        // $query = Student::with('classModel', 'payments');

        if ($request->filled('search')) {
            $query->where('address', 'like', '%' . $request->search . '%')
                ->orWhere('id', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('civil_id', 'like', '%' . $request->search . '%')
                ->orWhere('telephone_number', 'like', '%' . $request->search . '%')
                ->orWhere('nationality', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('recipt_number', 'like', '%' . $request->search . '%')
                ->orWhere('registration_id', 'like', '%' . $request->search . '%');
        }

        $testStudents = $query->get();

        return view('students.test_student', compact('testStudents', 'countStudent'));
    }

    public function studentImport(Request $request)
    {

        $request->validate([
            'file_import' => 'required|file|mimes:xlsx,xls,csv,tsv'
        ]);

        $file = $request->file('file_import');

        try {

           
            Excel::import(new studentImport(), $file);
          
            return back()->with('success', 'Student Imported successfully.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => $e->errorInfo[2]])->withInput($request->all());
        }
    }


    public function downloadCard($id)
    {
        $student = Student::findOrFail($id);

        $pdf = Pdf::loadView('students.download', compact('student'));

        return $pdf->download('studentIDDownload_' . $student->id . '.pdf');
    }
}
