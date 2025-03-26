<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class StudentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        return Student::select(
            'id',
            'is_test',
            'name',
            'date_of_birth',
             'civil_id',
             'registration_id',
             'nationality',
             'address',
             'status',
            'place_of_birth',
            'telephone_number',
            'recipt_number',
            'gender',
            'image',
            'attendance',
            'class_model_id',
            'joining_date',
            'qr_code',
            'barcode',
            'class_start_date',
            'class_end_date'
           
        
          
          ) ->with('classModel', 'payments')->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'is_test',
            'name',
            'date_of_birth',
             'civil_id',
             'registration_id',
             'nationality',
             'address',
             'status',
            'place_of_birth',
            'telephone_number',
            'recipt_number',
            'gender',
            'image',
            'attendance',
            'class_model_id',
            'joining_date',
            'qr_code',
            'barcode',
            'class_start_date',
            'class_end_date'

          
        ];
    }

    
}
