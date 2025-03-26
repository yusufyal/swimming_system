<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   
    public function index()
    {
        $payments = Payment::with(['enrollment', 'student'])->get();
        return view('payments.index', compact('payments'));
    }


    public function create()
    {
        $data['title'] = 'Add New Payment';
        $data['students'] = Student::select('name', 'id')->get();
        return view('payments.add', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'enrollment_id' => 'required|exists:enrollments,id',
            'amount' => 'required',
        ], 
        [
            'student_id.required' => 'The student is required.',
            'student_id.exists' => 'The selected student does not exist.',
            'enrollment_id.required' => 'The Enrollment is required.',
            'enrollment_id.exists' => 'The selected enrollment does not exist.',
        ]);

        $existingPayment = Payment::where([
            ['student_id', '=', $request->student_id],
            ['enrollment_id', '=', $request->enrollment_id],
        ])->first();
    
        if ($existingPayment) {
            return back()->withErrors(['error' => 'This enrollment payment already exists with the selected student.']);
        }

        $payment = new Payment();
        $payment->student_id = $request->student_id;
        $payment->enrollment_id = $request->enrollment_id;
        $payment->amount = $request->amount;
        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Payment added successfully.');
    }

    public function show(Payment $payment)
    {
        //
    }


    public function edit(Payment $payment)
    {
        //
    }


    public function update(Request $request, Payment $payment)
    {
        //
    }


    public function destroy(Payment $payment)
    {
        //
    }

    public function getEnrollments(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $enrollments = Enrollment::where('student_id', $request->student_id)
        ->with(['classModel', 'level'])
        ->get();

        $formattedEnrollments = $enrollments->map(function($enrollment) {
            return [
                'id' => $enrollment->id,
                'class_name' => $enrollment->classModel->name,
                'level_name' => $enrollment->level->name,
            ];
        });

        return response()->json([
            'enrollments' => $formattedEnrollments
        ]);
    }
}
