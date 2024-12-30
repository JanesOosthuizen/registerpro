<?php

namespace App\Http\Controllers;

use App\Models\Pupil;
use Illuminate\Http\Request;

class PupilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return all pupils with their associated class
        return Pupil::with('schoolClass')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id', // Must match an existing class ID
        ]);

        $pupil = Pupil::create($validated);

        return response()->json($pupil, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pupil $pupil)
    {
        // Return a specific pupil with class info
        return $pupil->load('schoolClass');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pupil $pupil)
    {
        $validated = $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'class_id' => 'sometimes|required|exists:classes,id',
        ]);

        $pupil->update($validated);

        return response()->json($pupil, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pupil $pupil)
    {
        $pupil->delete();

        return response()->noContent();
    }
}
