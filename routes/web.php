<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AuthController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\BatchController;
use App\Http\Controllers\Student\AssignmentController;
use App\Http\Controllers\Student\MaterialController;
use App\Http\Controllers\Website\CourseController as WebsiteCourseController;
use App\Http\Controllers\Trainer\AuthController as TrainerAuthController;
use App\Http\Controllers\Trainer\DashboardController as TrainerDashboardController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[WebsiteCourseController::class,'index'])->name('home');







Route::middleware('guest')->group(function () {
 Route::get('/student/login', [AuthController::class, 'showLogin'])->name('student.login');
 Route::post('/student/login', [AuthController::class, 'login'] )->name('student.login.submit');

});

Route::middleware(['auth', 'role:Student']) ->prefix('student')->name('student.')->group(function () {
 Route::get('/dashboard',[DashboardController::class, 'index'] )->name('dashboard');
  Route::get('/courses', [CourseController::class, 'index'] )->middleware('permission:courses.view')->name('courses.index');
  Route::get( '/batches',[BatchController::class, 'index'])->middleware('permission:batches.view')->name('batches.index');
  Route::get( '/assignments',[AssignmentController::class, 'index'])->middleware('permission:assignments.view')->name('assignments.index');
  Route::get('/materials', [MaterialController::class, 'index'])->middleware('permission:materials.view')->name('materials.index');

 Route::post( '/logout', [AuthController::class, 'logout'])->name('logout');
    });



    Route::middleware('guest')->group(function () {
    Route::get( '/trainer/login', [TrainerAuthController::class, 'showLogin'] )->name('trainer.login');
    Route::post('/trainer/login', [TrainerAuthController::class, 'login'] )->name('trainer.login.submit');

});


Route::middleware(['auth', 'role:Trainer'])->prefix('trainer') ->name('trainer.') ->group(function () {
Route::get( '/dashboard', [TrainerDashboardController::class, 'index'])->name('dashboard');
 Route::post('/logout', [TrainerAuthController::class, 'logout'] )->name('logout');

    });











Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
