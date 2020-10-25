<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\article;

function p($item)
{
    Log::debug($item);
}

class BlogController extends Controller
{
    function index()
    {
        $articles = article::orderby('created_at','desc')->get();
        return view('index',["articles"=>$articles]);
    }

    function detail($id){
        $article = article::find($id);
        if (!$article) return \App::abort(404);
        return view('detail',["article"=>$article]);
    }

    function create_get()
    {
        $articles = article::all();
        return view('create',['a'=>$articles]);
    }

    function create_post(Request $request)
    {
        $title = $_POST["title"];
        $content = $_POST["body"];

        if (!$title or !$content){
            $msg = "タイトルと本文を入力してください。";
            return view('create',compact("msg"));
        }

        $article = new article();
        $article->title = $title;
        $article->content = $content;
        if ($request->file("image")){
            $file_extension = pathinfo($request->file('image')->getClientOriginalName())["extension"];
            $path = $request->file("image")->storeas("public/eyecatch",UuidV4Factory::generate(). ".". $file_extension);
            $article->eyecatch_path = str_replace('public/','storage/',$path);
        }
        $article->save();

        return view('create');
    }

    function admin()
    {
        return view('admin');
    }

    function read()
    {
        $articles = article::all();
        return view('read',compact("articles"));
    }

    function update_get($id)
    {
        $article = article::find($id);
        return view("update",compact("article"));
    }

    function update_post($id,Request $request)
    {
        $title = $_POST["title"];
        $content = $_POST["body"];

        if (!$title or !$content){
            $msg = "タイトルと本文を入力してください。";
            $article = article::find($id);
            return view('update',compact("msg","article"));
        }

        $article = article::find($id);
        $article->title = $title;
        $article->content = $content;
        if ($request->file("image")){
            $file_extension = pathinfo($request->file('image')->getClientOriginalName())["extension"];
            $path = $request->file("image")->storeas("public/eyecatch",UuidV4Factory::generate(). ".". $file_extension);
            $article->eyecatch_path = str_replace('public/','storage/',$path);
        }
        $article->save();

        return view("update",compact("article"));
    }

    function delete_get()
    {
        
    }
}

class UuidV4Factory
{
    const PATTERN = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx';

    public static function generate(): string
    {
        $chars = str_split(self::PATTERN);

        foreach ($chars as $i => $char) {
            if ($char === 'x') {
                $chars[$i] = dechex(random_int(0, 15));
            } elseif ($char === 'y') {
                $chars[$i] = dechex(random_int(8, 11));
            }
        }

        return implode('', $chars);
    }
}