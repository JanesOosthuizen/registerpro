<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanningItem;
use Illuminate\Support\Facades\Auth;

class CellPlanningController extends Controller
{
    public function index($cellKey)
    {
        return PlanningItem::where('cell_key', $cellKey)->get();
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
}
