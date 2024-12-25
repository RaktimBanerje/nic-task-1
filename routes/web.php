<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('teacher')->name('teacher.')->group(function () {
    // Route to store a new teacher (POST request)
    Route::post('store', [UserController::class, 'store'])->name('store');
        
    // Route to view under review teacher joining requests (GET request)
    Route::get('under-review', [DashboardController::class, 'under_review'])->name('under_review');
});

// OTP Routes
Route::prefix('otp')->group(function () {
    // Route to send OTP to the user's email
    Route::post('/send', [UserController::class, 'sendOtp'])->name('otp.send');
    
    // Route to verify the OTP entered by the user
    Route::post('/verify', [UserController::class, 'verifyOtp'])->name('otp.verify');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';