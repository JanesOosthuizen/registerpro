<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Header::orderBy('column_index')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$validated = $request->validate([
			'column_index' => 'required|integer',
			'title' => 'required|string|max:255',
			'subtitle' => 'nullable|string|max:255',
		]);
	
		// Get the authenticated user's ID
		$userId = Auth::id();
	
		// Include the user_id in the data to be stored
		$header = Header::create([
			'user_id' => $userId,
			'column_index' => $validated['column_index'],
			'title' => $validated['title'],
			'subtitle' => $validated['subtitle'],
		]);
	
		return response()->json($header, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Header $header)
    {
        return response()->json($header, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Header $header)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        $header->update($validated);

        return response()->json($header, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Header $header)
    {
        $header->delete();

        return response()->json(['message' => 'Header deleted successfully.'], 200);
    }
}
