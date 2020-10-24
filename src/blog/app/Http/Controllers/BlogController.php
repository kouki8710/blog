<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\article;

class BlogController extends Controller
{
    function index()
    {
        return view('index');
    }

    function detail($id){
        return view('detail');
    }

    function create_get()
    {
        $articles = article::all();
        return view('create',['a'=>$articles]);
    }

    function create_post()
    {
        $title = $_POST["title"];
        $content = $_POST["body"];

        $article = new article();
        $article->title = $title;
        $article->content = $content;
        $article->save();

        return redirect('/create');
    }
}
