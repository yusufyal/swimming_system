<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'level_id',
        'instructor_id',
        'status',
        'days'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_model_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(StudentHistory::class, 'previous_class_model_id', 'id'); // Correct foreign and primary key mapping
    }
    

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Add accessors for the 'day' attribute
    public function getDaysAttribute($value)
    {
        return json_decode($value, true); // Deserialize the JSON string to an array
    }

    public function setDaysAttribute($value)
    {
        $this->attributes['days'] = json_encode($value); // Serialize the array to a JSON string
    }

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }
}
