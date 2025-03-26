<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassHistory implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $classId;

    // Constructor to accept class ID
    public function __construct($classId)
    {
        $this->classId = $classId;
    }

    public function collection()
    {
        return Student::select(
            'id',
            'name',
            'is_test',
            'address',
            'nationality',
            'place_of_birth',
            'date_of_birth',
            'telephone_number',
            'status',
            'gender',
            'registration_id',
            'joining_date',
            'civil_id',
            'recipt_number',
            'barcode',
            'qr_code',
            'attendance',
            'class_model_id',
            'class_start_date',
            'class_end_date'
        )->with('classModel', 'payments')
            ->where('class_model_id', $this->classId) // Filter by class ID
            ->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'is_test',
            'address',
            'nationality',
            'place_of_birth',
            'date_of_birth',
            'telephone_number',
            'status',
            'gender',
            'registration_id',
            'joining_date',
            'civil_id',
            'recipt_number',
            'barcode',
            'qr_code',
            'attendance',
            'class_model_id',
             'class_start_date',
            'class_end_date'

        ];
    }

  
  
}
