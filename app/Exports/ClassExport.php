<?php

namespace App\Exports;

use App\Models\ClassModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClassExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return ClassModel::select(
            'id',
            'name',
            'start_time',
            'end_time',
            'level_id',
            'instructor_id',
            'status',
            'days'
        )->with('level', 'instructor')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Start Time',
            'End Time',
            'Level ID',
            'Instructor ID',
            'Status',
            'Days',
        ];
    }

    /**
     * Apply styles to the worksheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Bold headings in the first row
            1 => ['font' => ['bold' => true]],
        ];
    }
}
