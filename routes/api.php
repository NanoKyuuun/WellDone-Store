<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/informasi', InformasiController::class);
Route::apiResource('/game', GameController::class);
Route::apiResource('/rank', RankController::class);
Route::apiResource('/worker', WorkerController::class);
