<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\SubscriptionController;


Route::get('setlanguage/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return redirect()->back(); // Redirect to the previous page
});

Route::get('/', function () {
    return redirect()->route('login');
});

//Route Student View
Route::get('students/view/{id}', [StudentController::class, 'view'])->name('students.view');

//Route Student Print Id Card
Route::get('students/print-id-card/{id}', [StudentController::class, 'printIDCard'])->name('print.id.card');

Route::middleware('auth')->group(function () {

    //Route Users
    Route::resource('users', UserController::class);

    //Route Students
    Route::resource('students', StudentController::class);

    //Route getclassgetail 
    Route::get('/get-class-details', [StudentController::class, 'getClassDetails'])->name('get-class-details');

    //Route getClassesByGender 
    Route::get('/get-classes-by-gender', [StudentController::class, 'getClassesByGender']);

    //  Route Export Students 
    Route::get('studentExport', [StudentController::class, 'studentExport'])->name('studentExport');

    //Student Import
    Route::Post('/studentImport', [StudentController::class, 'studentImport'])->name('studentImport');

    // card download
    
    Route::get('/student/downloadCard/{id}', [StudentController::class, 'downloadCard'])->name('student.downloadCard');


    //Route renew
    Route::get('student/renew/{id}', [StudentController::class, 'renew'])->name('students.renew');
    Route::get('/test', [StudentController::class, 'testStudent'])->name('students.testStudent');

    //Route Instructors
    Route::resource('instructors', InstructorController::class);

    Route::get('/get-instructors', [EnrollmentController::class, 'getInstructors'])->name('get-instructors');

    //Route Classes
    Route::resource('classes', ClassesController::class);

    Route::get('classes/view/{id}', [ClassesController::class, 'view'])->name('classes.view');

    Route::get('/api/instructors/{levelId}', [ClassesController::class, 'getInstructorsByLevel']);

    //  Route Export class 
    Route::get('/classExport', [ClassesController::class, 'classExport'])->name('classExport');
    Route::Post('/classImport', [ClassesController::class, 'classImport'])->name('classImport');

    //  Route Export class  History

    Route::get('/export/class-history/{classId}', [ClassesController::class, 'classHistory'])
        ->name('classExportHistory');

    //Route Levels
    Route::resource('levels', LevelController::class);

    //Route Enrollments
    Route::resource('enrollments', EnrollmentController::class);

    //Route Reports
    Route::resource('reports', ReportController::class);

    //Route Payments
    Route::resource('payments', PaymentController::class);

    Route::get('/get-enrollments', [PaymentController::class, 'getEnrollments'])->name('get-enrollments');

    //Route Attendance
    Route::resource('attendence', AttendenceController::class);

    Route::get('/student-attendence/{id}', [AttendenceController::class, 'studentAttendenceDetails'])->name('attendence.attendenceDetails');



    Route::get('/all-students', [AttendenceController::class, 'allStudents'])->name('attendence.studentDetails');

    Route::get('check-in/{id}', [AttendenceController::class, 'checkIn'])->name('attendence.check-in');

    Route::get('check-out/{id}', [AttendenceController::class, 'checkOut'])->name('attendence.check-out');


    // In routes/web.php or routes/api.php
    Route::get('/fetch-attendance', [AttendenceController::class, 'fetchStudentDetails']);

    Route::get('/mark_attendance', [AttendenceController::class, 'markAttendance'])->name('mark_attendance');

    // Route Packages
    Route::resource('packages', PackageController::class);

    //Route Subscription
    Route::resource('subscriptions', SubscriptionController::class);

    // Route Roles 
    Route::resource('roles', RoleController::class);

    Route::get('/assign-role', [RoleController::class, 'showAssignRole'])->name('show.assign.role.form');

    Route::post('/assign-role', [RoleController::class, 'assignRole'])->name('assign.role');


    // send card in Whatsapp

    Route::get('/student/download/{studentId}', [WhatsAppController::class, 'download'])->name('student.download');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('dashboard', DashboardController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
