<?php

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/{project}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('project-show');

    Route::get('/tasks', function () { return view('dashboard'); })->name('tasks');
});
