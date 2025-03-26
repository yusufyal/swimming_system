<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view package')->only(['index']);
        $this->middleware('permission:show package')->only(['show']);
        $this->middleware('permission:create package')->only(['create', 'store']);
        $this->middleware('permission:edit package')->only(['update', 'edit']);
        $this->middleware('permission:delete package')->only(['delete']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('packages.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'price' => 'required',
            'days' => 'required',
        ]);

        $packages = new Package();
        $packages->name = $request->name;
        $packages->detail = $request->detail;
        $packages->price = $request->price;
        $packages->days = $request->days;

        $packages->save();

        return redirect()->route('packages.index')->with('success', 'Package Add Successfully!');
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

        $package = Package::find($id);

        return view('packages.edit', compact('package'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'price' => 'required',
            'day' => 'day',
        ]);

        $packages = Package::findOrFail($id);
        $packages->name = $request->name;
        $packages->detail = $request->detail;
        $packages->price = $request->price;
        $packages->days = $request->days;

        $packages->save();

        return redirect()->route('packages.index')->with('success', 'Package Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);

        if ($package) {
            $package->delete();
        }
        return redirect()->route('packages.index')->with('danger', 'Package Deleted Successfully!');
    }
}
