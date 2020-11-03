<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogAPI;

Route::get('/', [BlogController::class, 'index']);
Route::get('/detail/{id}', [BlogController::class, 'detail']);
Route::get('/making',[BlogController::class,'making']);

// 管理関係 基本ビュー提供
Route::prefix('admin')->group(function(){
    Route::get('/', [BlogController::class, 'admin']);
    Route::get('/create', [BlogController::class, 'create_get']);
    Route::get('/update/{id}',[BlogController::class,'update_get']);
});

// API関係 CRUD本体
Route::prefix('api')->group(function(){
    Route::get('/get_all_articles',[BlogAPI::class,'get_all_articles']);
    Route::get('/get_article/{id}',[BlogAPI::class,'get_article']);
    Route::post('/delete/{id}',[BlogAPI::class,'delete']);
    Route::post('/create',[BlogAPI::class,'create_post']);
    Route::post('/update/{id}',[BlogAPI::class,'update_post']);
});
