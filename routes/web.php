<?php

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
    return redirect()->route('top-users');
});
Route::get('top-users', [App\Http\Controllers\TopUserController::class, 'index'])->name('top-users');
Route::get('/top-users/search', [App\Http\Controllers\TopUserController::class, 'search'])->name('search-user');
Route::get('/generate-top-users', [App\Http\Controllers\TopUserController::class, 'findTopUsers'])->name('generate-top-users');
