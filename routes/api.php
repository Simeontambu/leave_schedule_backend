<?php

use App\Http\Controllers\API\AgentController;
use App\Http\Controllers\API\CongeController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\PlanningController;
use App\Http\Controllers\API\UserController;
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

Route::post('user/create', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/agents/create', [AgentController::class, 'store']);
    Route::post('/conge/create', [CongeController::class, 'store']);
    Route::get('/conge', [CongeController::class, 'index']);
    Route::post('/planning/create', [PlanningController::class, 'store']);
    Route::get('/planning', [PlanningController::class, 'index']);
    Route::get('/agents', [AgentController::class, 'index']);
    Route::post('/logout', [LogoutController::class,'logout' ]);
   
    
});
