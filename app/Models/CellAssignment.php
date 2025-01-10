<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'row',
        'column',
        'class_id',
        'subject_id',
		'pupil_ids'
    ];

	protected $casts = [
        'pupil_ids' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classRelation()
	{
		return $this->belongsTo(SchoolClass::class, 'class_id');
	}

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
