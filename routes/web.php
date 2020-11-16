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

Route::get('/rituales', [App\Http\Controllers\RitualController::class, 'index'])->name('ritual');

Route::get('/videos', [App\Http\Controllers\VideoController::class, 'index'])->name('video');
Route::get('/resumen', [App\Http\Controllers\ResumenController::class, 'index'])->name('resumen');
Route::get('/soporte', [App\Http\Controllers\SupportController::class, 'index'])->name('soporte');

Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');