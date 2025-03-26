<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructorController extends Controller
{

    public function __construct(){
        $this->middleware('permission:view instructor')->only(['index']);
        $this->middleware('permission:show instructor')->only(['show']);
        $this->middleware('permission:create instructor')->only(['create', 'store']);
        $this->middleware('permission:edit instructor')->only(['update', 'edit']);
        $this->middleware('permission:delete instructor')->only(['delete']);

    }

    public function index()
    {
        $instructors = Instructor::with('levels')->get();
        $totalInstructors = Instructor::all()->count();
        return view('instructors.index', compact('instructors','totalInstructors'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('instructors.add', compact('levels'));
    }

    public function store(Request $request)
    {
        // Validation rules
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email',
            'phone' => 'required|string',
            'civil_id' => 'required|string|unique:instructors,civil_id|max:50',
            'date_of_birth' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'level_id' => 'required|array|min:1',
            'level_id.*' => 'exists:levels,id',
        ]);


        $instructor = new Instructor();
        $instructor->name = $request->name;
        $instructor->email = $request->email;
        $instructor->phone = $request->phone;
        $instructor->civil_id = $request->civil_id;
        $instructor->date_of_birth = $request->date_of_birth;
        $instructor->nationality = $request->nationality;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
        
            // Generate a unique name for the image
            $imageName = time() . '.' . $image->guessExtension();
            $path = $image->storeAs('images', $imageName, 'public');
        
            $instructor->image = $path; 
        } else {

            if (!$instructor->image) {
                $instructor->image = 'images/default.png';
            }
        }

        $instructor->save();

        if (!empty($request->level_id)) {

            $instructor->levels()->attach($request->level_id);
        } else {
            return back()->with('danger', 'Please select at least one level');
        }

        return redirect()->route('instructors.index')->with('success', 'Instructor Added successfully.');
    }



    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $instructor = Instructor::findOrFail($id);
        $levels = Level::all();
        return view('instructors.edit', compact('instructor', 'levels'));
    }


    public function update(Request $request, string $id)
    {
        $instructor = Instructor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email,' . $instructor->id,
            'phone' => 'required|string',
            'civil_id' => 'required|string|unique:instructors,civil_id,' . $instructor->id,
            'date_of_birth' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'level_id' => 'required|array|min:1',
            'level_id.*' => 'exists:levels,id',
        ]);
        $instructor->name = $request->name;
        $instructor->email = $request->email;
        $instructor->phone = $request->phone;
        $instructor->civil_id = $request->civil_id;
        $instructor->date_of_birth = $request->date_of_birth;
        $instructor->nationality = $request->nationality;

       
           // Handle image upload
           if ($request->hasFile('image')) {
            $image = $request->file('image');
            $existingImagePath = public_path('storage/' . $instructor->image);

            if (File::exists($existingImagePath)) {

                File::delete($existingImagePath);
            }
          
            $imageName = time() . '.' . $image->getClientOriginalExtension();
        
            $path = $image->storeAs('images', $imageName, 'public');
        
            $instructor->image = $path;
        }
        else {

            if (!$instructor->image) {
                $instructor->image = 'images/default.png';
            }
        }

        $instructor->save();
        if (!empty($request->level_id)) {
            $instructor->levels()->sync($request->level_id);
        } else {
            return back()->with('danger', 'Please select at least one level');
        }

        return redirect()->route('instructors.index')->with('success', 'Instructor updated successfully.');
    }

    public function destroy(string $id)
    {
        $instructor = Instructor::findOrFail($id);

        if ($instructor) {
            $imagePath = public_path('storage/' . $instructor->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $instructor->delete();
        }
        return redirect()->route('instructors.index')->with('danger', 'Instructor deleted successfully.');
    }
}
