<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Foundation\Application;
// use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmpleadoController::class, 'index'])->name('form');
Route::get('/empleados{search?}', [EmpleadoController::class, 'listar'])->name('listar');
Route::get('/empleados/{id}', [EmpleadoController::class, 'obtener'])->name('obtener');
Route::post('/empleados', [EmpleadoController::class, 'crear'])->name('crear');
Route::put('/empleados/{id}', [EmpleadoController::class, 'modificar'])->name('modificar');
Route::delete('/empleados/{id}', [EmpleadoController::class, 'eliminar'])->name('eliminar');
