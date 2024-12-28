<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::with('school')->get();
    }

 public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'date_of_birth' => 'required|date'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()->all()
        ], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'date_of_birth' => $request->date_of_birth,
        'school_id' => $request->school_id,
    ]);

    return response()->json($user, 201);
}

    public function show(User $user)
    {
        return $user->load('school');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'surname' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'school_id' => 'sometimes|exists:schools,id',
        ]);

        $user->update($request->all());
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
