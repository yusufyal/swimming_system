<?php

namespace App\Observers;

use App\Models\Student;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\File;
use Picqer\Barcode\BarcodeGenerator;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        //QR Code Generate

        // Define the QR Code content (e.g., student ID)
        $qrCodeContent = "https://reach.link/qadsiaswimmingacademy"; // The URL for the QR Code
        // $qrCodeContent = "https://www.instagram.com/qadsia.swimming.club/?hl=en"; // The URL for the QR Code

        // Sanitize the filename (e.g., hash the URL)
        $filename = md5($qrCodeContent) . '.png'; // Generate a unique filename based on the URL

        // Define the file path for storing QR codes
        $qrCodeDirectory = public_path('qrcodes');
        $qrCodePath = $qrCodeDirectory . '/' . $filename;

        // Create the directory if it doesn't exist
        if (!File::exists($qrCodeDirectory)) {
            File::makeDirectory($qrCodeDirectory, 0777, true, true);
        }

        // Generate the QR Code
        $result = Builder::create()
            ->data($qrCodeContent) // The URL will be encoded in the QR Code
            ->encoding(new Encoding('UTF-8'))
            ->size(200) // Size of the QR Code
            ->build();

        // Save the QR Code as a PNG file
        $result->saveToFile($qrCodePath);

        // Save the QR Code path in the student's record
        $student->qr_code ='qrcodes/'. $filename; // Relative path to the QR Code file
        
        $student->save();


        // Generate barcode 

        $barcodeContent = $student->registration_id;
        $barcodePath = 'barcodes/' . $barcodeContent . '.png';
        $barcodeDirectory = public_path('barcodes');
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeContent, BarcodeGenerator::TYPE_CODE_128);

        file_put_contents(public_path($barcodePath), $barcodeImage);

        $student->barcode ='public/'. $barcodePath;
        $student->save();
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
