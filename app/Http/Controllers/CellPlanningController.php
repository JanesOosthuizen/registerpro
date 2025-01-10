<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanningItem;

class CellPlanningController extends Controller
{
    public function index($cellKey)
    {
        return PlanningItem::where('cell_key', $cellKey)->get();
    }

    public function store(Request $request, $cellKey)
    {
        $item = PlanningItem::create([
            'cell_key' => $cellKey,
            'class_name' => $request->className,
            'subject' => $request->subject,
            'pupils' => $request->pupils,
            'content' => $request->content,
        ]);

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
}
