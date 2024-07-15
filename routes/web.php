<?php

use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('sections', SectionController::class);