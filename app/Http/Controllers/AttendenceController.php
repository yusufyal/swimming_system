<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Attendence;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AttendenceController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view attendance')->only(['index']);
        $this->middleware('permission:show attendance')->only(['show', 'studentAttendenceDetails']);
        $this->middleware('permission:create attendance')->only(['create', 'store']);
        $this->middleware('permission:edit attendance')->only(['update', 'edit']);
        $this->middleware('permission:delete attendance')->only(['delete']);
    }

    public function index()
    {
        $attendences = Attendence::with('student')->get();
        return view('attendence.index', compact('attendences'));
    }

    public function studentAttendenceDetails($id)
    {
        $attendences = Attendence::with('student')->where('student_id', $id)->get();
        return view('attendence.index', compact('attendences', 'id'));
    }

    public function allStudents(Request $request)
    {
        $students = [];

        // Check if filter_class and filter_date are both set
        $query = Student::query();

        // Filter by class name if provided
        if (isset($request->filter_class) && !empty($request->filter_class)) {
            $query->whereHas('classModel', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filter_class . '%');
            });
        }

        // Fetch students based on both filter_date and filter_class
        if (isset($request->filter_date) && !empty($request->filter_date)) {
            // Get attendance records for the selected date
            $presentStudents = Attendence::with('student')
                ->where('status', 'present')
                ->where('date', $request->filter_date)
                ->get();

            // Filter students who are present on the selected date
            foreach ($presentStudents as $presentStudent) {
                // Check if the student belongs to the selected class
                if (
                    $presentStudent->student->classModel &&
                    stripos($presentStudent->student->classModel->name, $request->filter_class) !== false
                ) {
                    $students[] = $presentStudent->student;
                }
            }

            // Return filtered students based on both date and class
            return view('attendence.students', compact('students'));
        } else {
            // If no date filter, return students filtered by class only
            $students = $query->get();
            return view('attendence.students', compact('students'));
        }
    }





    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Attendence $attendence)
    {
        //
    }

    public function edit(Attendence $attendence)
    {
        //
    }

    public function update(Request $request, Attendence $attendence)
    {
        //
    }

    public function destroy($id)
    {
        // Find the student record
        $student = Student::find($id);

        if ($student) {
            // Delete all attendance records related to the student
            Attendence::where('student_id', $id)->delete();

            // Delete the student record
            $student->delete();
        }

        return redirect()->route('attendence.students')->with('success', 'Student and attendance records deleted successfully.');
    }




    public function checkIn($id)
    {
        // Assign the provided ID to a variable
        $Id = $id;

        // Get the current date in 'Y-m-d' format
        $current_date = Carbon::now()->toDateString();

        // Get the current time in 'H:i:s' format with timezone +05:00
        $current_time = Carbon::now('+03:00')->toTimeString();

        // Get the current day name (e.g., Monday, Tuesday)
        $current_day = date("l");

        // Find the student record by ID
        $student = Student::find($Id);

        // Insert a new attendance record with the current date, time, and day
        Attendence::insert([
            'date' => $current_date,
            'day' => $current_day,
            'clock_in' => $current_time,
            'clock_out' => null,
            'status' => 'Present',
            'student_id' => $Id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Update the student's attendance status to 'Checked-In'
        $student->attendance = 1;

        // Save the updated student record to the database
        $student->save();

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function fetchStudentDetails(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'registration_id' => 'required|exists:students,registration_id',
        ]);

        // Retrieve student data with related models
        $student = Student::with('classModel', 'payments')
            ->where('registration_id', $request->registration_id)
            ->firstOrFail();

        $studentEnrollment = Enrollment::where('student_id', $student->id)->first();
        $attendance = Attendence::where('student_id', $student->id)->get();

        // Get the current date
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now('+03:00')->toTimeString();
        $currentDay = date("l");

        // Check if the student is expired based on class end date
        $classEndDate = Carbon::parse($student->class_end_date);
        if ($classEndDate->lt(Carbon::today())) {
            $student->status = 'Expired';
        }

        // Check if attendance is already marked for the day
        $attendanceExists = Attendence::where('student_id', $student->id)
            ->where('date', $currentDate)
            ->exists();

        // Define the default attendance message
        if ($student->status === 'Expired') {
            $attendanceMessage = [
                'message' => 'Attendance not marked, student status expired!',
                'message_color' => 'red',
            ];
        } elseif ($attendanceExists) {
            $attendanceMessage = [
                'message' => 'Attendance already marked for today!',
                'message_color' => 'blue',
            ];
        } else {
            // Mark attendance if student is active
            Attendence::insert([
                'date' => $currentDate,
                'day' => $currentDay,
                'clock_in' => $currentTime,
                'clock_out' => null,
                'status' => 'Present',
                'student_id' => $student->id,
            ]);

            // Fetch updated attendance data immediately after marking attendance
            $attendance = Attendence::where('student_id', $student->id)->get();

            $attendanceMessage = [
                'message' => 'Attendance marked successfully!',
                'message_color' => 'green',
            ];
        }

        // Retrieve the latest payment amount
        $latestPayment = $student->payments->sortByDesc('created_at')->first();
        $latestPaymentAmount = $latestPayment
            ? 'KWD ' . $latestPayment->amount
            : 'No payment exists';

        // Prepare the response data
        $responseData = [
            'name' => $student->name,
            'address' => $student->address,
            'telephone_number' => $student->telephone_number,
            'date_of_birth' => $student->date_of_birth,
            'place_of_birth' => $student->place_of_birth,
            'gender' => $student->gender,
            'nationality' => $student->nationality,
            'status' => $student->status, // Ensure correct status is returned
            'joining_date' => $student->joining_date,
            'image' => $student->image ?: 'default.png',
            'class' => $student->classModel ? $student->classModel->name : 'No class exists',
            'attendance_message' => $attendanceMessage,
        ];

        // Return the response with attendance data immediately after marking attendance
        return response()->json([
            'success' => true,
            'data' => $responseData,
            'attendance' => $attendance, // Immediate attendance data after marking
            'studentEnrollment' => $studentEnrollment,
        ]);
    }



    public function markAttendance()
    {

        return view('attendence.mark_attendance');
    }
}
