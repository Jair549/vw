<?php

use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('sections', SectionController::class);
Route::get('sections/{section}/create', [SectionController::class, 'create'])->name('sections.create');
Route::post('sections', [SectionController::class, 'store'])->name('sections.store');
Route::get('sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
