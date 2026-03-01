<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampController;
use App\Http\Controllers\FamilyController;
 
Route::get('/', function () {
    return view('dashboard', [
        'camps_count' => \App\Models\Camp::count(),
        'families_count' => \App\Models\Family::count(),
      ]);
})->name('dashboard');

Route::resource('camps', CampController::class);
Route::resource('families', FamilyController::class);
