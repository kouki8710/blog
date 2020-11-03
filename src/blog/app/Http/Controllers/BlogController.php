<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\article;

// 表示関数
function p($item)
{
    Log::debug($item);
}


class BlogController extends Controller
{
    function index()
    {
        return view('index');
    }

    function detail($id){
        $article = article::find($id);
        if (!$article) return \App::abort(404);
        return view('detail',["article"=>$article]);
    }

    function making(){
        return view("making");
    }

    function create_get()
    {
        return view('create');
    }

    
    function admin()
    {
        return view('admin');
    }

    function update_get($id)
    {
        return view("update");
    }

    
}

