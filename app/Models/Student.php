<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable  = [
        'name',
        'gender',
        'date_of_birth',
        'civil_id',
        'status',
        'nationality',
        'address',
        'place_of_birth',
        'telephone_number',
        'recipt_number',
        'image',
        'attendance',
        'class_model_id',
        'registration_id',
        'joining_date',
        'qr_code',
        'barcode',
        'class_start_date',
        'class_end_date',
        'comment'
    ];

    // Mutators save data in db
    public function setRegistrationIdAttribute($value)
    {
        $this->attributes['registration_id'] = "QSA-25-" . $value;
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_model_id', 'id'); // assuming 'class_model_id' is the foreign key in the students table
    }


    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendence::class,'student_id');
    }

    public function histories()
    {
        return $this->hasMany(StudentHistory::class, 'student_id', 'id'); // Correct foreign and primary key mapping
    }
    
}
