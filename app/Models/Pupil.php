<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_id',
    ];

    /**
     * Relationship: A pupil belongs to a class.
     */
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
