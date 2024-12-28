<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return School::with('users')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        return School::create($request->all());
    }

    public function show(School $school)
    {
        return $school->load('users');
    }

    public function update(Request $request, School $school)
    {
        $school->update($request->only(['name', 'address', 'city']));
        return $school;
    }

    public function destroy(School $school)
    {
        $school->delete();
        return response()->noContent();
    }
}
