<?php

namespace App\Imports;

use App\Models\ClassModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Ensure 'days' is properly formatted
            $days = $row['days'];
            $value = json_decode($days);

            ClassModel::create([
                'name' => $row['name'],
                'start_time' => $row['start_time'],
                'end_time' => $row['end_time'],
                'level_id' => $row['level_id'],
                'instructor_id' => $row['instructor_id'],
                'status' => $row['status'],
                'days' => $value, // Store proper JSON
            ]);
        }
    }
}


