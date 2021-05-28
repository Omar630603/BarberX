<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationStatusController;
use App\Http\Controllers\FullCalendarController;
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
        return view('admin.profile');
    }
    return redirect()->route('login');
});
Route::resource('/admins', UserController::class);
// Sementara, nanti bisa diubah

// Reservation Route
Route::resource('reservation', ReservationController::class);
Route::resource('reservationStatus', ReservationStatusController::class);



// Service Route
Route::resource('service', ServiceController::class);
Route::resource('categoryService', CategoryServiceController::class);

// Customer Route
Route::resource('/customer', CustomerController::class);

// Message Route
Route::resource('message', MessageController::class);

// Gallery Route
Route::resource('gallery', GalleryController::class);

// Profile Route
Route::get('/profile', function () {
    return view('admin.profile');
});

// Employee Route
Route::resource('employee', EmployeeController::class);

// Calendar Route
Route::get('/calendar', [FullCalendarController::class, 'index'])->name('calendar.index');

// print pdf route Route
Route::get('/reservation/printPdf/{reservation}', [ReservationController::class, 'printReservationPDF'])->name('printReservationPDF');
Route::get('/reservationStatus/printPdf', [ReservationStatusController::class, 'print_pdf'])->name('print_pdf');