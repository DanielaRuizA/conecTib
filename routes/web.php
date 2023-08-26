<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//rutas para seleccionar país, departamento, ciudad
Route::get('dependent-dropdown', [RegisteredUserController::class, 'index']);
Route::post('api/fetch-states', [RegisteredUserController::class, 'fetchState']);
Route::post('api/fetch-cities', [RegisteredUserController::class, 'fetchCity']);

//ruta del listado de usuarios solo para el administrador
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});
