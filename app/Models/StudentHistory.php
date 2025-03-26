<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'previous_class_model_id',
        'previous_class_start_date',
        'previous_class_end_date',
        'transferred_at',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'previous_class_model_id', 'id');
    }

 
}
