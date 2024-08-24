<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
Auth::routes();

// Display login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Optional: Redirect the root URL to the login form
Route::get('/', function () {
    return redirect()->route('login');
});

// Handle login form submission
Route::post('/login', [LoginController::class, 'login']);

// Student and teacher routes
Route::get('/students/data', [StudentController::class, 'getData'])->name('students.data');
Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/teachers', [TeacherController::class, 'list'])->name('teachers.list');

// Home route with authentication middleware
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);
