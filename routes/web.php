<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin Route
Route::get('/admin', function () {
    return redirect()->route('login');
});
Route::get('/register', function () {
    return redirect()->route('login');
});
Route::get('/admin/index', function () {
    if (Auth::check()) {
        return view('admin.adminIndex');
    }
    return redirect()->route('login');
});
// Sementara, nanti bisa diubah

// Reservation Route
Route::get('/reservation', function () {
    return view('admin.reservationIndex');
});
Route::get('/reservationStatus', function () {
    return view('admin.reservationStatusIndex');
});

// Service Route
Route::resource('service', ServiceController::class);
Route::resource('categoryService', CategoryServiceController::class);

// User Route
Route::get('/customer', function () {
    return view('admin.customerIndex');
});

// Message Route
Route::get('/message', function () {
    return view('admin.messageIndex');
});

// Gallery Route
Route::get('/gallery', function () {
    return view('admin.galleryIndex');
});

// Profile Route
Route::get('/profile', function () {
    return view('admin.profile');
});

// Employee Route
<<<<<<< HEAD
Route::get('/employee', function () {
    return view('admin.employee');
});
=======
Route::resource('employee', EmployeeController::class);


>>>>>>> 65b0b7d990c980db3d5dd80d16a75538110faeb7
