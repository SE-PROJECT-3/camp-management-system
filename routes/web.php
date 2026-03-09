<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\DistributionController;

Route::get('/', function () {
    return view('dashboard', [
        'camps_count' => \App\Models\Camp::count(),
        'families_count' => \App\Models\Family::count(),
        'distributions_count' => \App\Models\Distribution::count(),
    ]);
})->name('dashboard');
Route::get('/reports', function () {
    return view('reports.index');
})->name('reports.index');
Route::get('/attendance-reports', function () {
    return view('reports.attendance');
})->name('reports.attendance');
Route::view('/aid-reports', 'reports.aid');
Route::view('/family-aid-history', 'reports.family-aid-history');

Route::resource('camps', CampController::class);
Route::resource('families', FamilyController::class);

