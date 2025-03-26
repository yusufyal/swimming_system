<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendence extends Model
{
    use HasFactory;




    // Accessor for clock_in to display time in 'g:i A' format
    public function getClockInAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('g:i A') : null;
    }

    // Accessor for clock_out to display time in 'g:i A' format
    public function getClockOutAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('g:i A') : null;
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    

}
