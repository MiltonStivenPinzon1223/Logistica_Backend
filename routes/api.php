<?php

use App\Http\Controllers\AssistenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ColletionAccountsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TypeCertificateController;
use App\Http\Controllers\TypeClothingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResource('assitences', AssistenceController::class);
    Route::apiResource('certificates', CertificateController::class);
    Route::apiResource('collections/accounts', ColletionAccountsController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('logistics', LogisticController::class);
    Route::apiResource('rols', RolController::class);
    Route::apiResource('types/certificates', TypeCertificateController::class);
    Route::apiResource('types/clothings', TypeClothingController::class);
});