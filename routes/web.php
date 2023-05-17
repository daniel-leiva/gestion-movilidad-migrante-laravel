<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigranteController;
use App\Http\Controllers\NucleoController;
use App\Http\Controllers\CaravanaController;
use App\Http\Controllers\RegistroMovilidadController;
use App\Http\Controllers\RegistroEnfermoController;
use App\Http\Controllers\RegistroConductaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin\UserController;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('/users', UserController::class)->names('admin.users');

//Ruta para Nucleos
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/nucleos', [NucleoController::class, 'index'])->name('nucleos.index');
    Route::post('/nucleo/store', [NucleoController::class, 'store'])->name('nucleos.store');
    Route::get('/nucleo/create', [NucleoController::class, 'create'])->name('nucleos.create');
    Route::get('/nucleo/{id}/show', [NucleoController::class, 'show'])->name('nucleos.show');
    Route::put('/nucleo/{id}/update', [NucleoController::class, 'update'])->name('nucleos.update');
    Route::get('/nucleo/{id}/destroy', [NucleoController::class, 'destroy'])->name('nucleos.destroy');
    Route::delete('/nucleo/{id}/destroy', [NucleoController::class, 'destroy'])->name('nucleos.destroy');
    Route::get('/nucleo/{id}/edit', [NucleoController::class, 'edit'])->name('nucleos.edit');
});

//Ruta para Caravanas
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/caravanas', [CaravanaController::class, 'index'])->name('caravanas.index');
    Route::post('/caravana/store', [CaravanaController::class, 'store'])->name('caravanas.store');
    Route::get('/caravana/create', [CaravanaController::class, 'create'])->name('caravanas.create');
    Route::get('/caravana/{id}/show', [CaravanaController::class, 'show'])->name('caravanas.show');
    Route::put('/caravana/{id}/update', [CaravanaController::class, 'update'])->name('caravanas.update');
    Route::get('/caravana/{id}/destroy', [CaravanaController::class, 'destroy'])->name('caravanas.destroy');
    Route::delete('/caravana/{id}/destroy', [CaravanaController::class, 'destroy'])->name('caravanas.destroy');
    Route::get('/caravana/{id}/edit', [CaravanaController::class, 'edit'])->name('caravanas.edit');
});

//Ruta para Migrantes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/migrantes', [MigranteController::class, 'index'])->name('migrantes.index');
    Route::post('/migrante/store', [MigranteController::class, 'store'])->name('migrantes.store');
    Route::get('/migrante/create', [MigranteController::class, 'create'])->name('migrantes.create');
    Route::get('/migrante/{id}/show', [MigranteController::class, 'show'])->name('migrantes.show');
    Route::put('/migrante/{id}/update', [MigranteController::class, 'update'])->name('migrantes.update');
    Route::get('/migrante/{id}/destroy', [MigranteController::class, 'destroy'])->name('migrantes.destroy');
    Route::delete('/migrante/{id}/destroy', [MigranteController::class, 'destroy'])->name('migrantes.destroy');
    Route::get('/migrante/{id}/edit', [MigranteController::class, 'edit'])->name('migrantes.edit');
});

//Ruta para Registro Movilidad
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/registros_movilidad', [RegistroMovilidadController::class, 'index'])->name('registro_movilidads.index');
    Route::post('/registro_movilidad/store', [RegistroMovilidadController::class, 'store'])->name('registros_movilidads.store');
    Route::get('/registro_movilidad/create', [RegistroMovilidadController::class, 'create'])->name('registro_movilidads.create');
    Route::get('/registro_movilidad/{id}/show', [RegistroMovilidadController::class, 'show'])->name('registro_movilidads.show');
    Route::put('/registro_movilidad/{id}/update', [RegistroMovilidadController::class, 'update'])->name('registro_movilidads.update');
    Route::get('/registro_movilidad/{id}/destroy', [RegistroMovilidadController::class, 'destroy'])->name('registro_movilidads.destroy');
    Route::delete('/registro_movilidad/{id}/destroy', [RegistroMovilidadController::class, 'destroy'])->name('registro_movilidads.destroy');
    Route::get('/registro_movilidad/{id}/edit', [RegistroMovilidadController::class, 'edit'])->name('registros_movilidad.edit');
});

//Ruta para Registro Enfermos
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/registro_enfermos', [RegistroEnfermoController::class, 'index'])->name('registro_enfermos.index');
    Route::post('/registro_enfermo/store', [RegistroEnfermoController::class, 'store'])->name('registro_enfermos.store');
    Route::get('/registro_enfermo/create', [RegistroEnfermoController::class, 'create'])->name('registro_enfermos.create');
    Route::get('/registro_enfermo/{id}/show', [RegistroEnfermoController::class, 'show'])->name('registro_enfermos.show');
    Route::put('/registro_enfermo/{id}/update', [RegistroEnfermoController::class, 'update'])->name('registro_enfermos.update');
    Route::get('/registro_enfermo/{id}/destroy', [RegistroEnfermoController::class, 'destroy'])->name('registro_enfermos.destroy');
    Route::delete('/registro_enfermo/{id}/destroy', [RegistroEnfermoController::class, 'destroy'])->name('registro_enfermos.destroy');
    Route::get('/registro_enfermo/{id}/edit', [RegistroEnfermoController::class, 'edit'])->name('registro_enfermos.edit');
    Route::get('/select2/registro_enfermos', [RegistroEnfermoController::class, 'select2_migrantes']);
});

//Ruta para Registros Conducta
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/registros_conducta', [RegistroConductaController::class, 'index'])->name('registros_conductas.index');
    Route::post('/registro_conducta/store', [RegistroConductaController::class, 'store'])->name('registros_conducta.store');
    Route::get('/registro_conducta/create', [RegistroConductaController::class, 'create'])->name('registros_conducta.create');
    Route::get('/registro_conducta/{id}/show', [RegistroConductaController::class, 'show'])->name('registros_conducta.show');
    Route::put('/registro_conducta/{id}/update', [RegistroConductaController::class, 'update'])->name('registros_conducta.update');
    Route::get('/registro_conducta/{id}/destroy', [RegistroConductaController::class, 'destroy'])->name('registros_conducta.destroy');
    Route::delete('/registro_conducta/{id}/destroy', [RegistroConductaController::class, 'destroy'])->name('registros_conducta.destroy');
    Route::get('/registro_conducta/{id}/edit', [RegistroConductaController::class, 'edit'])->name('registros_conducta.edit');
});

//Ruta para Charts
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/inicio', [ChartController::class, 'index']);
    Route::get('/api/migrantes', [ChartController::class, 'migrantes'])->middleware('can:admin.api.index');
    Route::get('/api/registros_movilidad', [ChartController::class, 'registros_movilidad'])->middleware('can:admin.api.index');
});