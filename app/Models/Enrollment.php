<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $guarded = [
        'student_id',
        'class_id',
        'level_id',
        'instructor_id',
        'date_of_start',
        'date_of_join',
        'status',
        'day',
        'time'
    ];

    public function getDayAttribute($value)
    {
        return json_decode($value, true); // Deserialize the JSON string to an array
    }

    // Mutator to format time before saving to the database
    public function setDayAttribute($value)
    {
        $this->attributes['day'] = json_encode($value); // Serialize the array to a JSON string
    }

    public function setTimeAttribute($value)
    {
        // Convert the time to 24-hour format (HH:mm:ss) before storing in the database
        $this->attributes['time'] = Carbon::parse($value)->format('H:i:s');
    }

    // Accessor to format the time when retrieving from the database
    public function getTimeAttribute($value)
    {
        return Carbon::parse($value)->format('g:i A');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);  // One enrollment has one payment
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
}