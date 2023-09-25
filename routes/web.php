<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/alunos', [AlunosController::class, 'index']);
Route::get('/alunos/novo', [AlunosController::class, 'create']);
Route::post('/alunos/novo', [AlunosController::class, 'store']);

Route::get('/alunos/editar/{id}', [AlunosController::class, 'edit']);
Route::post('/alunos/editar/', [AlunosController::class, 'update']);
Route::get('/alunos/delete/{id}', [AlunosController::class, 'destroy']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aluno', function () {
    return view('/aluno');
})->middleware(['auth', 'verified'])->name('/aluno');

Route::middleware('auth')->group(function () {
    Route::get('/aluno', [ProfileController::class, 'edit']);
    Route::patch('/aluno', [ProfileController::class, 'update']);
    Route::delete('/aluno', [ProfileController::class, 'destroy']);
});


require __DIR__.'/auth.php';
