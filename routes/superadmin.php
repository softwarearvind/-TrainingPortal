<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\AuthController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\TrainingCategoryController;
use App\Http\Controllers\SuperAdmin\CourseController;
use App\Http\Controllers\SuperAdmin\TrainerController;
use App\Http\Controllers\SuperAdmin\StudentController;
use App\Http\Controllers\SuperAdmin\BatchController;
use App\Http\Controllers\SuperAdmin\TrainingSessionController;
use App\Http\Controllers\SuperAdmin\VideoController;
use App\Http\Controllers\SuperAdmin\StudyMaterialController;
use App\Http\Controllers\SuperAdmin\AssignmentController;
use App\Http\Controllers\SuperAdmin\OnlineTestController;
use App\Http\Controllers\SuperAdmin\CertificateController;
use App\Http\Controllers\CertificateVerificationController;

Route::middleware('web')->prefix('super-admin')->name('super-admin.') ->group(function () {
 Route::get('/login', [ AuthController::class,'showLogin' ])->name('login');
 Route::post('/login', [AuthController::class,'login'])->name('login.submit');


 Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

  // User Management
   Route::resource('users', UserController::class)->except(['show']);
   Route::patch('/users/{user}/toggle-status',[UserController::class, 'toggleStatus'] )->name('users.toggle-status');
  // User Roles
  Route::resource( 'roles',RoleController::class)->except(['show']);
  //training-categories

  Route::resource('training-categories',TrainingCategoryController::class)->except(['show']);
  Route::patch('/training-categories/{trainingCategory}/toggle-status',[TrainingCategoryController::class, 'toggleStatus'])->name('training-categories.toggle-status'
);

//Course

Route::resource( 'courses', CourseController::class)->except(['show']);
Route::patch('/courses/{course}/toggle-status', [CourseController::class, 'toggleStatus'])->name('courses.toggle-status');

//Trainers

Route::resource('trainers', TrainerController::class)->except(['show']);
Route::patch('/trainers/{trainer}/toggle-status', [TrainerController::class, 'toggleStatus'])->name('trainers.toggle-status'
);

// student
Route::resource( 'students',StudentController::class)->except(['show']);
Route::patch('/students/{student}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggle-status');

//batches

Route::resource( 'batches',BatchController::class)->except(['show']);

//training-sessions
Route::resource('training-sessions',TrainingSessionController::class)->except(['show']);

//videos
Route::resource('videos',VideoController::class)->except(['show']);
Route::patch('/videos/{video}/toggle-status',[VideoController::class, 'toggleStatus'])->name('videos.toggle-status');

//

Route::resource( 'study-materials',StudyMaterialController::class)->except(['show']);
Route::patch('/study-materials/{studyMaterial}/toggle-status',[StudyMaterialController::class, 'toggleStatus'])->name('study-materials.toggle-status');

//

Route::resource('assignments', AssignmentController::class)->except(['show']);
Route::patch('/assignments/{assignment}/toggle-status',[AssignmentController::class, 'toggleStatus'])->name('assignments.toggle-status');


//
Route::resource( 'online-tests',OnlineTestController::class);
Route::patch('/online-tests/{onlineTest}/toggle-status',[OnlineTestController::class, 'toggleStatus'])->name('online-tests.toggle-status');

//

Route::resource('certificates',CertificateController::class)->except(['show']);
Route::get('/certificates/{certificate}',[CertificateController::class, 'show'])->name('certificates.show');
Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
Route::get( '/certificate/verify/{code}', [CertificateVerificationController::class, 'verify'])->name('certificate.verify');

 Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');

    });


