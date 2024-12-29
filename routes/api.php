<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\HimaController;
use App\Http\Controllers\API\DosenController;
use App\Http\Controllers\API\PesanController;
use App\Http\Controllers\API\AgendaController;
use App\Http\Controllers\API\AlumniController;
use App\Http\Controllers\API\KontakController;
use App\Http\Controllers\API\KontenController;
use App\Http\Controllers\API\KabinetController;
use App\Http\Controllers\API\KurikulumController;
use App\Http\Controllers\API\JenisKontenController;



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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Route::apiResource('/pesans', App\Http\Controllers\Api\PesanController::class);


Route::middleware('auth:sanctum')->group(function () {
    // Route::apiResource('/kontaks', App\Http\Controllers\Api\KontakController::class);
    // Route::apiResource('/dosens', App\Http\Controllers\Api\DosenController::class);
    // Route::apiResource('/alumnis', App\Http\Controllers\Api\AlumniController::class);

    // Route::apiResource('/kurikulums', App\Http\Controllers\Api\KurikulumController::class);
    // Route::apiResource('/agendas', App\Http\Controllers\Api\AgendaController::class);
    // Route::apiResource('/kabinets', App\Http\Controllers\Api\KabinetController::class);
    // Route::apiResource('/himas', App\Http\Controllers\Api\HimaController::class);
    // Route::apiResource('/jenis_kontens', App\Http\Controllers\Api\JenisKontenController::class);
    // Route::apiResource('/kontens', App\Http\Controllers\Api\KontenController::class);
    // Route::apiResource('/faqs', App\Http\Controllers\Api\FaqController::class);
});
