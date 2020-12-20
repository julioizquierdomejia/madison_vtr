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
	Route::post('/rituales', [App\Http\Controllers\RitualController::class, 'ajaxstore'])->name('ritual.store');
	Route::get('/', [App\Http\Controllers\RitualController::class, 'index'])->name('ritual');

	Route::get('/videos', [App\Http\Controllers\VideoController::class, 'index'])->name('video');
	Route::post('/videos', [App\Http\Controllers\VideoController::class, 'ajaxstore'])->name('videos.upload');
	Route::get('/videos/{objective}/{part}/list', [App\Http\Controllers\VideoController::class, 'getVideoList'])->name('videos.byObjective');
	Route::post('/videos/{id}/delete', [App\Http\Controllers\VideoController::class, 'destroy'])->name('videos.delete');
	Route::get('/resumen', [App\Http\Controllers\ResumenController::class, 'index'])->name('resumen');
	Route::get('/soporte', [App\Http\Controllers\SupportController::class, 'index'])->name('soporte');

	Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');
	Route::post('/perfil', [App\Http\Controllers\PerfilController::class, 'update'])->name('perfil.update');
	Route::post('/seguridad', [App\Http\Controllers\PerfilController::class, 'security'])->name('perfil.security');
	Route::post('/foto', [App\Http\Controllers\PerfilController::class, 'upload_photo'])->name('perfil.photo');

	Route::get('/planes', [App\Http\Controllers\PlanController::class, 'index'])->name('planes');
	//Route::get('/clientes', [App\Http\Controllers\ClientController::class, 'index'])->name('clientes');


	Route::get('clientes', [App\Http\Controllers\ClientController::class, 'index'])->name('clientes.index');
	Route::get('clientes/crear', [App\Http\Controllers\ClientController::class, 'create'])->name('clientes.create');
	Route::post('clientes/store', [App\Http\Controllers\ClientController::class, 'store'])->name('clientes.store');

	Route::resource('/objetivos', App\Http\Controllers\ObjetiveController::class);

	Route::get('/solicitar-videos', [App\Http\Controllers\VideoRequestController::class, 'index'])->name('request_video');
	Route::post('/solicitar-videos', [App\Http\Controllers\VideoRequestController::class, 'ajaxstore'])->name('request_video.upload');
	Route::get('/solicitar-videos/{id}/ver', [App\Http\Controllers\VideoRequestController::class, 'show'])->name('request_video.show');
});
