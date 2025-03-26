<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Level;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('classModel', 'level', 'student', 'instructor')->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $data['students'] = Student::select('name', 'id')->get();
        $data['class_models'] = ClassModel::select('name', 'id')->get();
        $data['instructors'] = Instructor::select('name', 'id')->get();
        $data['levels'] = Level::select('name', 'id')->get();

        return view('enrollments.add', compact('data'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate(
            [
                'student_id' => 'required|exists:students,id',
                'class_id' => 'required|exists:class_models,id',
                'level_id' => 'required|exists:levels,id',
                'instructor_id' => 'required|exists:instructors,id',
                'start_date' => 'required',
                'day' => 'required',
                'time' => 'required',
            ],
            [
                'student_id.required' => 'The student is required.',
                'student_id.exists' => 'The selected student does not exist.',
                'class_id.required' => 'The class is required.',
                'class_id.exists' => 'The selected class does not exist.',
                'level_id.required' => 'The level is required.',
                'level_id.exists' => 'The selected level does not exist.',
                'instructor_id.required' => 'The instructor is required.',
                'instructor_id.exists' => 'The selected instructor does not exist.',
                'start_date.required' => 'The start date is required.',
                'day.required' => 'The day is required.',
                'time.required' => 'The time is required.',
            ]
        );

        $existingEnrollment = Enrollment::where([
            ['student_id', '=', $request->student_id],
            ['class_id', '=', $request->class_id],
            ['level_id', '=', $request->level_id],
            ['instructor_id', '=', $request->instructor_id],
        ])->first();

        if ($existingEnrollment) {
            return back()->withErrors(['error' => 'This enrollment already exists with the selected student, class, level, and instructor.']);
        }
        $input = $request->all();
        $input['status'] = 'Active';

        $enrollment = Enrollment::create($input);
        return redirect()->route('enrollments.index')->with('success', 'Student enrolled successfully');
    
    
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {

        $enrollment = Enrollment::findOrFail($id);
        $data['students'] = Student::select('name', 'id')->get();
        $data['class_models'] = ClassModel::select('name', 'id')->get();
        $data['instructors'] = Instructor::select('name', 'id')->get();
        $data['levels'] = Level::select('name', 'id')->get();

        return view('enrollments.edit', compact('enrollment', 'data'));
    }


    public function update(Request $request, string $id)
    {
       
        $validated = $request->validate(
            [
                'student_id' => 'required|exists:students,id',
                'class_id' => 'required|exists:class_models,id',
                'level_id' => 'required|exists:levels,id',
                'instructor_id' => 'required|exists:instructors,id',
                'start_date' => 'required|date',
                'day' => 'required',
                'time' => 'required',
            ],
            [
                'student_id.required' => 'The student is required.',
                'student_id.exists' => 'The selected student does not exist.',
                'class_id.required' => 'The class is required.',
                'class_id.exists' => 'The selected class does not exist.',
                'level_id.required' => 'The level is required.',
                'level_id.exists' => 'The selected level does not exist.',
                'instructor_id.required' => 'The instructor is required.',
                'instructor_id.exists' => 'The selected instructor does not exist.',
                'start_date.required' => 'The start date is required.',
                'start_date.date' => 'The start date must be a valid date.',
                'day.required' => 'The day is required.',
                'time.required' => 'The time is required.',
            ]
        );
    
        $enrollment = Enrollment::findOrFail($id);
        $existingEnrollment = Enrollment::where([
            ['student_id', '=', $request->student_id],
            ['class_id', '=', $request->class_id],
            ['level_id', '=', $request->level_id],
            ['instructor_id', '=', $request->instructor_id],
        ])->where('id', '!=', $id) 
        ->first();
    
        if ($existingEnrollment) {
            return back()->withErrors(['error' => 'This enrollment already exists with the selected student, class, level, and instructor.']);
        }
    
        $enrollment->update([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'level_id' => $request->level_id,
            'instructor_id' => $request->instructor_id,
            'date_of_join' => $request->date_of_join,
            'date_of_expire' => $request->date_of_expire,
            'day' => $request->day,
            'time' => $request->time,
            'status' =>$request->status ,
        ]);
    
        return redirect()->route('enrollments.index')->with('success', 'Student enrollment updated successfully.');
    }
  
    public function destroy($id)
    {
        $enrollment = Enrollment::find($id);

        if ($enrollment) {
            $enrollment->delete();
            return redirect()->route('enrollments.index')->with('danger', 'Enrollment deleted successfully.');
        }

        return redirect()->route('enrollments.index')->with('error', 'Enrollment not found.');
    }

    public function getInstructors(Request $request)
    {
        $validated = $request->validate([
            'class_model_id' => 'required|exists:class_models,id',
            'level_id' => 'required|exists:levels,id',
        ]);

        $instructors = Instructor::where('class_id', $request->class_model_id)
            ->where('level_id', $request->level_id)
            ->get();

        return response()->json([
            'instructors' => $instructors
        ]);
    }
}
