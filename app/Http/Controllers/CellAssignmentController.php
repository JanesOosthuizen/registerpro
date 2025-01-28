<?php

namespace App\Http\Controllers;

use App\Models\CellAssignment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CellAssignmentController extends Controller
{
    /**
     * Create or update a cell assignment.
     *
     * POST /cell-assignments
     * Body example:
     * {
     *   "user_id": 1,
     *   "row": 0,
     *   "column": 1,
     *   "class_id": 2,
     *   "subject_id": 3
     * }
     */
    public function store(Request $request)
    {
		$userId = Auth::id();

        // 1) Build a validator with the required rules
        $validator = Validator::make($request->all(), [
            'row'        => 'required|integer',
            'column'     => 'required|integer',
            'class_id'   => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
			'pupil_ids'  => 'required|array', 
            'pupil_ids.*'=> 'exists:pupils,id',
        ]);

        // 2) Check if the validation fails
        if ($validator->fails()) {
            // Return a 422 status with all error messages
            return response()->json([
                'message' => 'Validation errors occurred.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Create or update: if you want only one record per (user_id, row, column), use updateOrCreate
        $assignment = CellAssignment::updateOrCreate(
            [
                'user_id' => $userId,
                'row'     => $request->row,
                'column'  => $request->column,
            ],
            [
                'class_id'   => $request->class_id,
                'subject_id' => $request->subject_id,
				'pupil_ids'  => $request->pupil_ids,
            ]
        );

        return response()->json([
            'message' => 'Cell assignment created/updated successfully',
            'data'    => $assignment,
        ], 200);
    }

    /**
     * Fetch all cell assignments for the *authenticated* user.
     *
     * GET /cell-assignments
     */
    public function index(Request $request)
    {
        // If you're using standard Laravel auth (e.g., Sanctum), get the user's ID:
        $userId = Auth::id();

        // If you need to test quickly and you have no auth set up, or you want to pass user_id explicitly, you could do:
        // $userId = $request->query('user_id'); // or $request->user_id

        // Query all assignments for that user, with class/subject relationships
        // We'll rename 'class' -> 'classRelation' to avoid confusion with PHP 'class'
        $assignments = CellAssignment::where('user_id', $userId)
            ->with(['classRelation', 'subject'])
            ->get();

        // Transform the data to include class_name and subject_name
        $response = $assignments->map(function ($assignment) {
            return [
                'id'           => $assignment->id,
                'row'          => $assignment->row,
                'column'       => $assignment->column,
                'class_id'     => $assignment->class_id,
                'subject_id'   => $assignment->subject_id,
                'class_name'   => optional($assignment->classRelation)->name,
                'subject_name' => optional($assignment->subject)->name,
				'pupil_ids'    => $assignment->pupil_ids,
            ];
        });

        return response()->json($response, 200);
    }

/**
 * Delete a cell assignment.
 *
 * DELETE /cell-assignments/{id}
 */
public function destroy($row, $column)
{
    $userId = Auth::id();

    // Find the assignment for the authenticated user with the given row and column
    $assignment = CellAssignment::where('user_id', $userId)
        ->where('row', $row)
        ->where('column', $column)
        ->first();

    // If the assignment doesn't exist, return a 404 error
    if (!$assignment) {
        return response()->json([
            'message' => 'Cell assignment not found.',
        ], 404);
    }

    // Delete the assignment
    $assignment->delete();

    return response()->json([
        'message' => 'Cell assignment deleted successfully.',
    ], 200);
}


}
