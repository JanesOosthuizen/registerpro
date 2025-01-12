<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanningItem;
use App\Models\PlanningItemNote;
use Illuminate\Support\Facades\Auth;

class CellPlanningController extends Controller
{
    public function index($cellKey)
    {
        return PlanningItem::where('cell_key', $cellKey)->get();
    }

    public function getById($id)
    {
        return PlanningItem::where('id', $id)->get();
    }

    public function store(Request $request, $cellKey)
    {
		$userId = Auth::id(); // Get the authenticated user

		$payload = [
            'cell_key' => $cellKey,
            'class_name' => $request->className,
            'subject' => $request->subject,
            'pupils' => $request->pupils,
            'content' => $request->content,
			'user_id' => $userId,
			'date' => $request->date, 
        ];

        $item = PlanningItem::create($payload);

        return response()->json($item, 201);
    }

    public function storeNoCell(Request $request)
    {
		$userId = Auth::id(); // Get the authenticated user

		$payload = [
            'cell_key' => null,
            'class_name' => $request->className,
            'subject' => $request->subject,
            'pupils' => $request->pupils,
            'content' => $request->content,
			'user_id' => $userId,
			'date' => $request->date,
        ];

        $item = PlanningItem::create($payload);

        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = PlanningItem::findOrFail($id);
        $item->update([
            'class_name' => $request->className,
            'subject' => $request->subject,
            'pupils' => $request->pupils,
            'content' => $request->content,
        ]);

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = PlanningItem::findOrFail($id);

        $item->delete();

        return response()->noContent();
    }

	public function getUserPlannings(Request $request)
	{
		$userId = Auth::id(); // Get the authenticated user

		// Assuming each planning item is linked to a user_id in the database
		$plannings = PlanningItem::where('user_id', $userId)->get();

		return response()->json($plannings, 200);
	}

	public function getNotes($id)
	{
		$notes = PlanningItem::findOrFail($id)->notes;
		return response()->json($notes);
	}

	public function addNote(Request $request, $id)
	{
		$request->validate([
			'date' => 'required|date',
			'content' => 'required|string',
		]);

		$note = PlanningItemNote::create([
			'planning_item_id' => $id,
			'date' => $request->date,
			'content' => $request->content,
		]);

		return response()->json($note, 201);
	}

	public function updateNote(Request $request, $id)
	{
		$note = PlanningItemNote::findOrFail($id);

		$request->validate([
			'date' => 'required|date',
			'content' => 'required|string',
		]);

		$note->update([
			'date' => $request->date,
			'content' => $request->content,
		]);

		return response()->json($note);
	}

	public function deleteNote($id)
	{
		$note = PlanningItemNote::findOrFail($id);
		$note->delete();

		return response()->json(['message' => 'Note deleted successfully.']);
	}

}
