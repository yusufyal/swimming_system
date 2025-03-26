<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Picqer\Barcode\BarcodeGenerator;
use Illuminate\Queue\SerializesModels;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateBarcodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $student = $this->student;
        $barcodeContent = $student->registration_id;
        $barcodePath = 'barcodes/' . $barcodeContent . '.png';

        $barcodeDirectory = public_path('barcodes');

        // Create barcode directory if not exists
        if (!is_dir($barcodeDirectory)) {
            mkdir($barcodeDirectory, 0777, true);
        }

        // Generate the barcode
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeContent, BarcodeGenerator::TYPE_CODE_39);

        // Save the barcode image
        file_put_contents(public_path($barcodePath), $barcodeImage);

        // Update the student's barcode path in the database
        $student->barcode = $barcodePath;
        $student->save();
    }
}
