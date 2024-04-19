<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

//Rotas Anônimas
Route::post('/register',[AuthController::class, 'Register']);
Route::post('/login', [AuthController::class,'Login']);
Route::get('/user/{username}', [UserController::class, 'Profile']);
//Rotas autenticadas
Route::middleware(['auth:api'])->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/self','Self');
    });
    Route::controller(PostController::class)->group(function(){
        Route::post('/post', 'Create');
        Route::get('/posts/self', 'AuthUserPosts');
        Route::delete('/post/{id}', 'Delete');
    });
    
});

Route::get('users', [UserController::class, 'getAll']);