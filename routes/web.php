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


//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['guest:' . config('admin-auth.defaults.guard')])->group(function () {
	Route::get('/', function () {
	    return view('auth.login');
	});
});

Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth:' . config('admin-auth.defaults.guard')])->group(function () {
	Route::get('/rituales', [App\Http\Controllers\RitualController::class, 'index'])->name('ritual');
	Route::get('/', [App\Http\Controllers\RitualController::class, 'index'])->name('ritual');

	Route::get('/videos', [App\Http\Controllers\VideoController::class, 'index'])->name('video');
	Route::post('/videos', [App\Http\Controllers\VideoController::class, 'ajaxstore'])->name('videos.upload');
	Route::get('/resumen', [App\Http\Controllers\ResumenController::class, 'index'])->name('resumen');
	Route::get('/soporte', [App\Http\Controllers\SupportController::class, 'index'])->name('soporte');

	Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');

	Route::get('/planes', [App\Http\Controllers\PlanController::class, 'index'])->name('planes');
	//Route::get('/clientes', [App\Http\Controllers\ClientController::class, 'index'])->name('clientes');


	Route::resource('clientes', App\Http\Controllers\ClientController::class);

});
