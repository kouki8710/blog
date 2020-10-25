<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', [BlogController::class, 'index']);
Route::get('/detail/{id}', [BlogController::class, 'detail']);

// 管理関係 CRUD処理
Route::prefix('admin')->group(function(){
    Route::get('/', [BlogController::class, 'admin']);
    Route::get('/create', [BlogController::class, 'create_get']);
    Route::post('/create',[BlogController::class,'create_post']);
    Route::get('/read',[BlogController::class,'read']);
    Route::get('/update/{id}',[BlogController::class,'update_get']);
    Route::post('/update/{id}',[BlogController::class,'update_post']);
    Route::get('/delete/{id}',[BlogController::class,'delete']);
    
});
