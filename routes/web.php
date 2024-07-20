<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\WorkerController;
use App\Models\Worker;
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

Route::get('/register', [AuthController::class,'registView'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginView'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/informasi', [InformasiController::class, 'index']);
    Route::get('/informasi/{id}/edit', [InformasiController::class, 'edit']);

    Route::get('/game', [GameController::class, 'index']);
    Route::get('/game/{game}/edit', [GameController::class, 'edit']);

    Route::get('/rank', [RankController::class, 'index']);
    Route::get('/rank/{rank}/edit', [RankController::class, 'edit']);

    Route::get('/worker', [WorkerController::class, 'index']);
    Route::get('/worker/{worker}/edit', [WorkerController::class, 'edit']);
});

