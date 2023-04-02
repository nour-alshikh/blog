<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Books:read
Route::get('/books' , [ApiBookController::class , 'index']);
Route::get('/books/show/{id}' , [ApiBookController::class , 'show']);

Route::middleware('isApiUser')->group(function(){
    // Books:store
    Route::post('/books/store' , [ApiBookController::class , 'store']);

    // Book :update
    Route::post('/books/update/{id}' , [ApiBookController::class , 'update']);

    // Books : delete
    Route::get('/books/delete/{id}' , [ApiBookController::class , 'delete']);
});

// Auth
Route::post('/handle-login' , [ApiAuthController::class , 'handleLogin']);
Route::post('/handle-register' , [ApiAuthController::class , 'handleRegister']);
Route::post('/logout' , [ApiAuthController::class , 'logout']);

