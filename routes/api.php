<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalledController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
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


Route::get('/', function () {
    return ["msg" => "API Sucess"];
});

Route::post('login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('user',[UserController::class, 'store'])->middleware('ability:user-store');
    Route::get('users',[UserController::class, 'index'])->middleware('ability:user-index');
    Route::get('user/{uuid}',[UserController::class, 'show'])->middleware('ability:user-show');
    Route::patch('user/{uuid}',[UserController::class, 'update'])->middleware('ability:user-update');
    Route::put('user/{uuid}',[UserController::class, 'destroy'])->middleware('ability:user-destroy');
    Route::get('user/restore/{uuid}',[UserController::class, 'restore'])->middleware('ability:user-restore');
    Route::post('called',[CalledController::class, 'store'])->middleware('ability:called-store');
    Route::get('called',[CalledController::class, 'index'])->Middleware('ability:called-index');
    Route::post('establishment',[EstablishmentController::class, 'store'])->Middleware('ability:establishment-store');
    Route::get('establishments',[EstablishmentController::class, 'index'])->Middleware('ability:establishment-index');
    Route::get('establishment/{uuid}',[EstablishmentController::class, 'show'])->Middleware('ability:establishment-show');
    Route::post('logout',[AuthController::class, 'logout']);
});







