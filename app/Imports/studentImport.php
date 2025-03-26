<?php

namespace App\Imports;


use App\Models\Payment;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class studentImport implements ToCollection, WithHeadingRow
{


    public function collection(Collection $rows)
    {
        function parseDate($date)
        {
            if (empty($date) || is_null($date)) {
                return null;
            }

            if (is_numeric($date)) {
                // Convert Excel numeric date to a valid date
                return Carbon::createFromTimestamp(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($date))->format('Y-m-d');
            }

            try {
                return Carbon::parse($date)->format('Y-m-d');
            } catch (\Exception $e) {
                return null; // Return null if parsing fails
            }
        }
        foreach ($rows as $row) {

            $validatedClassModelId = $row['class_model_id'] ?? 1;

            // Check if the class model exists
            $classModel = ClassModel::find($validatedClassModelId);

            if (!$classModel) {
                // Handle error if the class_model_id doesn't exist
                return response()->json(['error' => 'Invalid class model ID'], 400);
            }


            $student = Student::create([
                'name' => $row['name'] ?? '',
                'date_of_birth' => parseDate($row['date_of_birth']) ?? '1900-01-01',
                'joining_date' => parseDate($row['joining_date']),
                'class_start_date' => parseDate($row['class_start_date']),
                'class_end_date' => parseDate($row['class_end_date']),
               'civil_id' => str_pad((string)($row['civil_id'] ?? ''), 12, '0', STR_PAD_LEFT),
                
                'nationality' => $row['nationality'] ?? '',
                'place_of_birth' => $row['place_of_birth'] ?? '',
                'address' => $row['address'] ?? '',
                'telephone_number' => $row['telephone_number'] ?? '',
                'recipt_number' => $row['recipt_number'] ?? '',
                'gender' => in_array($row['gender'], ['Male', 'Female']) ? $row['gender'] : 'Male',
                'class_model_id' => $validatedClassModelId,
                'registration_id' => Str::uuid(),
                'is_test' => 0,
                'status' => 'Active',
            ]);

            $payment = new Payment();
            $payment->student_id = $student->id;
            $payment->class_model_id = $student->class_model_id;
            $payment->payment_date =  now()->toDateString();
            $payment->payment_time =  now()->toTimeString();
            $payment->amount = $row['amount'] ?? 0;
            $payment->save();
        }
    }
}