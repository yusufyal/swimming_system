<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'civil_id',
        'nationality',
        'date_of_birth',
        'image',
    
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'instructor_level');
    }


}