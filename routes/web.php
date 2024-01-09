<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
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
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/store', [TasksController::class, 'store'])->name('tasks.store');;
    Route::get('/tasks/edit/{id}', [TasksController::class, 'edit'])->name('tasks.edit');;
    Route::put('/tasks/update/{id}', [TasksController::class, 'update'])->name('tasks.update');;
    Route::delete('/tasks/{id}', [TasksController::class, 'destroy'])->name('tasks.destroy');;
});

require __DIR__ . '/auth.php';
