<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Models\Pupil;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return all classes
        return SchoolClass::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'teacher' => 'nullable|string|max:255',
        ]);

        $schoolClass = SchoolClass::create($validated);

        return response()->json($schoolClass, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass)
	{
		return $schoolClass->load('pupils');
	}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolClass $schoolClass)
    {
        $validated = $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'teacher' => 'nullable|string|max:255',
        ]);

        $schoolClass->update($validated);

        return response()->json($schoolClass, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        return response()->noContent();
    }

	public function getPupilsByClass($classId)
	{
		$pupils = Pupil::where('class_id', $classId)->get();
		return response()->json($pupils);
	}
}
