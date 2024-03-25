<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
Route::post('/user',[UserController::class,'Create']);
Route::get('/user/{id}', [UserController::class,'getById']);
Route::post('login', [AuthController::class,'Login']);
Route::middleware('auth:api')->get('/self', [UserController::class, 'self']);