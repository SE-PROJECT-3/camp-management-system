<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware('auth')->group(function () {
Route::get('/', function () {
    return view('dashboard', [
        'camps_count' => \App\Models\Camp::count(),
        'families_count' => \App\Models\Family::count(),
        'distributions_count' => \App\Models\Distribution::count(),
    ]);
})->name('dashboard')->middleware('auth');

});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('camps', CampController::class);
    Route::resource('distributions', DistributionController::class);
});


Route::middleware(['auth', 'permission:view families'])->group(function () {
    Route::resource('families', FamilyController::class);
});


 Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
   
   
     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('camps', CampController::class);
        Route::resource('distributions', DistributionController::class);
    });

 
    Route::middleware(['permission:view families'])->group(function () {
        Route::resource('families', FamilyController::class);
    });
