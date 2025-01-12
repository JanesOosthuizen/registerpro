<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cell_key',
        'class_name',
        'subject',
        'pupils',
		'user_id',
    ];

	public function notes()
    {
        return $this->hasMany(PlanningItemNote::class);
    }
}