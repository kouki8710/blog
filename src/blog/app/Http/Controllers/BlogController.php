<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\article;

use Illuminate\Support\Facades\Auth;

// 表示関数
function p($item)
{
    Log::debug($item);
}


class BlogController extends Controller
{
    function index(Request $request)
    {
        return view('blog.index');
    }

    function new()
    {
        return view('blog.new');
    }

    function detail($id){
        $article = article::find($id);
        if (!$article) return \App::abort(404);
        return view('blog.detail',["article"=>$article]);
    }

    function making(){
        return view("blog.making");
    }    
}

