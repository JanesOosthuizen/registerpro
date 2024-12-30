<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'teacher',
    ];

	public function pupils()
	{
		return $this->hasMany(Pupil::class, 'class_id');
	}
}
