<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Instructor;
use Illuminate\Http\Request;

class LevelController extends Controller
{

    public function __construct(){
        $this->middleware('permission:view level')->only(['index']);
        $this->middleware('permission:show level')->only(['show']);
        $this->middleware('permission:create level')->only(['create', 'store']);
        $this->middleware('permission:edit level')->only(['update', 'edit']);
        $this->middleware('permission:delete level')->only(['delete']);

    }

    public function index()
    {
        $levels = Level::all();
        $totalLevels = Level::all()->count();
        return view('levels.index', compact('levels','totalLevels'));
    }


    public function create()
    {
        return view('levels.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'

        ]);
        
        $levels = new Level();
        $levels->name = $request->name;
        $levels->save();



        return redirect()->route('levels.index')->with('success', 'Level Added Successfully');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $level = Level::findOrFail($id);
        return view('levels.edit', compact('level'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'

        ]);

        $levels = Level::findOrFail($id);
        $levels->name = $request->name;
        $levels->save();
        return redirect()->route('levels.index')->with('success', 'Level Updated Successfully');
    }

    public function destroy(string $id)
    {
        $level = Level::findOrFail($id);
        if ($level) {
            $level->delete();
        }
        return redirect()->route('levels.index')->with('danger', 'Level Deleted Successfully');
    }
}
