<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'class_model_id ', 'payment_date', 'payment_time','amount'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_model_id');
    }
    
}