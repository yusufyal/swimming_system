<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $students = Student::with('classModel','payments')->get();
        return view('reports.index',compact('students'));
    }


    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
