<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

class WhatsAppController extends Controller
{
    public function download(Request $request, $studentId)
    {
        // Fetch student details
        $student = Student::findOrFail($studentId);

        // Generate PDF from the Blade view
        $pdf = Pdf::loadView('students.download', ['student' => $student]);

        // Define the storage path
        $pdfPath = storage_path('app/public/pdfs/download_' . $student->id . '.pdf');

        // Save the PDF file
        $pdf->save($pdfPath);

        // Return the PDF as a download response
        return response()->download($pdfPath)->deleteFileAfterSend(true);
    }

    public function view()
    {
        return view('students.download');
    }
}
