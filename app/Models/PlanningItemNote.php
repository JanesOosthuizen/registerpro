<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningItemNote extends Model
{
    use HasFactory;

    protected $fillable = ['planning_item_id', 'date', 'content'];

    public function planningItem()
    {
        return $this->belongsTo(PlanningItem::class);
    }
}
