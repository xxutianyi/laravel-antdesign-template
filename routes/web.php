<?php

use App\Http\Controllers\Auth as Auth;
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

Route::get('/login/local', [Auth\LocalSessionController::class, 'create'])->name('login.create');
Route::post('/login/local', [Auth\LocalSessionController::class, 'store'])->name('login.store');
Route::get('/login/wecom', [Auth\WorkWeixinController::class, 'callback'])->name('login.wecom');
Route::get('/logout', [Auth\LocalSessionController::class, 'destroy'])->name('login.destroy');

Route::get('/dashboard', \App\Http\Controllers\WelcomeController::class)->name('dashboard');
Route::get('/welcome', \App\Http\Controllers\WelcomeController::class)->name('welcome');
