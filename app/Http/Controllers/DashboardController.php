<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Instructor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalSubscriptions = Payment::count();
        $totalClasses = ClassModel::count();
        $instructors = Instructor::all();
        $studentTotal = Student::all();
        $students = Student::orderBy('created_at', 'desc')->limit(25)->get();
        $activeStudent = Student::where('status', 'Active')->get();
        $totalPayment = Payment::sum('amount');

        return view('dashboard', compact('students', 'activeStudent', 'instructors', 'totalClasses', 'totalPayment', 'totalSubscriptions', 'studentTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
