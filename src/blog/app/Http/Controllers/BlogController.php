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
        $articles = article::all();
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
            return redirect('/create');
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

        return redirect('/create');
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