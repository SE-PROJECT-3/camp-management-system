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
        'resources_count' => \App\Models\Resource::count(),
        'distributions_count' => \App\Models\Distribution::count(),
    ]);
})->name('dashboard');

Route::resource('camps', CampController::class);
Route::resource('families', FamilyController::class);
Route::resource('resources', ResourceController::class);
Route::resource('distributions', DistributionController::class);
