<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_level');
    }
}