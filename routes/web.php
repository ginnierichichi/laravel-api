<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [MoviesController::class, 'index'])->name('movie.index');
Route::get('/movie/{movie}', [MoviesController::class, 'show'])->name('movie.show');
Route::get('/actors/page/{page?}', [ActorsController::class, 'index'])->name('actors.index');
Route::get('/actors/{actor}', [ActorsController::class, 'show'])->name('actors.show');

Route::get('/tv', [TvController::class, 'index'])->name('tv.index');
Route::get('/tv/{show}', [TvController::class, 'show'])->name('tv.show');


