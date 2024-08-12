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
Route::get('sections/{section}/edit/{id}', [SectionController::class, 'editField'])->name('sections.editField');
Route::put('sections/{section}', [SectionController::class, 'update'])->name('sections.update');
Route::put('sections/{section}/edit/{id}', [SectionController::class, 'updateField'])->name('sections.updateField');

Route::group(['prefix' => '/painel'], function(){
    Route::get('/{section}', [SectionController::class, 'show'])->name('panel.show');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');