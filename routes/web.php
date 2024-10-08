<?php

use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SectionController::class, 'index'])->name('index');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function(){

    Route::group(['prefix' => '/painel'], function(){
        Route::get('/', [SectionController::class, 'logo'])->name('panel.logo');
        Route::get('/{section}', [SectionController::class, 'show'])->name('panel.show');
        Route::get('/{section}/create', [SectionController::class, 'create'])->name('sections.create');
        Route::post('/{section}', [SectionController::class, 'store'])->name('sections.store');
        Route::get('/{section}/edit/{fieldId}', [SectionController::class, 'edit'])->name('sections.edit');
        Route::put('/{section}/{fieldId}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/{section}/{fieldId}/remove-file/{fileId}', [SectionController::class, 'removeFile'])->name('sections.remove.file');
        Route::delete('/{section}/{fieldId}/remove-main-file/{fileId}', [SectionController::class, 'removeMainFile'])->name('sections.remove.main-file');
        Route::delete('/{section}/{fieldId}', [SectionController::class, 'removeField'])->name('sections.remove.field');
    });

});

// Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Auth::routes(['register' => false]);