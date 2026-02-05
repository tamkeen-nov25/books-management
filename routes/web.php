<?php

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('home');
})->name("home");

// Language switching
Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::resource('books', BookController::class);
