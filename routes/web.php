<?php

use App\Http\Controllers\Web\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('books', BookController::class);

Route::get('home', function () {
    return view('home');
})->name("home");
