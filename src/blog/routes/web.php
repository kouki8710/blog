<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogAPI;
use App\Http\Controllers\AdminController;

Route::get('/', [BlogController::class, 'index'])->name("index");
Route::get('/new', [BlogController::class, 'new']);
Route::get('/detail/{id}', [BlogController::class, 'detail']);
Route::get('/making',[BlogController::class,'making']);
Route::get('/adminlogin',function(){
    return view("admin.adminlogin");
});
Route::get('profile',function(){
    return view("blog.profile");
});

// 管理関係 基本ビュー提供
Route::prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'admin']);
    Route::get('/create', [AdminController::class, 'create_get']);
    Route::get('/update/{id}',[AdminController::class,'update_get']);
    Route::get('/create/tag',[AdminController::class,'create_tag']);
});

// API関係 CRUD本体
Route::prefix('api')->group(function(){
    Route::get('/get_all_new_articles', [BlogAPI::class,'get_all_new_articles']);
    Route::get('/get_all_public_new_articles', [BlogAPI::class,'get_all_public_new_articles']);
    Route::get('/get_all_recommend_articles', [BlogAPI::class,'get_all_recommend_articles']);
    Route::get('/get_article/{id}', [BlogAPI::class,'get_article']);
    Route::get('/get_tags', [BlogAPI::class,'get_tags']);
    Route::get('/get_relative_articles/{id}', [BlogAPI::class,'get_relative_articles']);

    Route::post('/delete/{id}', [BlogAPI::class,'delete']);
    Route::post('/create', [BlogAPI::class,'create_post']);
    Route::post('/update/{id}', [BlogAPI::class,'update_post']);
    Route::post('/create_tag', [BlogAPI::class,'create_tag']);
    Route::post('/delete_tag/{id}', [BlogAPI::class,'delete_tag']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
