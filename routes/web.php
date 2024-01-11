<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\SportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/fish', [SportController::class, 'fish'])->name("sports.fish");

Route::resource('sports', SportController::class)->middleware(['auth']);
Route::post('/sports/{id}/upload', [SportController::class, 'upload'])->name('sports.upload');

Route::resource('athletes', AthleteController::class);

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth'])->name('home');

Route::get('/contacts', function () {
    return view('sport.contact');
})->name('contacts');

Route::get('/about', function () {
    return view('sport.propos');
})->name('about');
