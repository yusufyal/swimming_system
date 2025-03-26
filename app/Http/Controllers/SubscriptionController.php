<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view subscription')->only(['index']);
        $this->middleware('permission:show subscription')->only(['show']);
        $this->middleware('permission:create subscription')->only(['create', 'store']);
        $this->middleware('permission:edit subscription')->only(['update', 'edit']);
        $this->middleware('permission:delete subscription')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Payment::with('student')->get();
        return view('subscriptions.index',compact('subscriptions'));
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
