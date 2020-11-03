<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\article;
use Illuminate\Support\Facades\Log;

class BlogAPI extends Controller
{
    function get_all_articles()
    {
        $articles = article::orderby('created_at','desc')->get();
        return json_encode(compact("articles"));
    }

    function get_article($id){
        $article = article::find($id);
        return json_encode($article);
    }

    function delete($id)
    {
        $article = article::find($id);
        if (!$article) return \App::abort(404);
        $article->delete();
        return json_encode(["status"=>"success","msg"=>"削除に成功しました","redirect"=>"/admin/"]);
    }

    function create_post(Request $request)
    {
        $title = $_POST["title"];
        $content = $_POST["body"];
        $row_content = $_POST["row_content"];

        if (!$title or !$content){
            $msg = "タイトルと本文を入力してください。";
            $status = 0;
            return json_encode(compact("msg","status"));
        }

        $article = new article();
        $article->title = $title;
        $article->content = $content;
        $article->row_content = $row_content;
        if ($request->file("image")){
            $file_extension = pathinfo($request->file('image')->getClientOriginalName())["extension"];
            $path = $request->file("image")->storeas("public/eyecatch",UuidV4Factory::generate(). ".". $file_extension);
            $article->eyecatch_path = str_replace('public/','storage/',$path);
        }
        $article->save();
        return json_encode(["status"=>"success","msg"=>"保存に成功しました。","redirect"=>"/admin/"]);
    }

    function update_post($id,Request $request)
    {
        $title = $_POST["title"];
        $content = $_POST["body"];
        $row_content = $_POST["row_content"];

        if (!$title or !$content){
            $msg = "タイトルと本文を入力してください。";
            $article = article::find($id);
            return json_encode(compact("msg"));
        }

        $article = article::find($id);
        $article->title = $title;
        $article->content = $content;
        $article->row_content = $row_content;
        if ($request->file("image")){
            $file_extension = pathinfo($request->file('image')->getClientOriginalName())["extension"];
            $path = $request->file("image")->storeas("public/eyecatch",UuidV4Factory::generate(). ".". $file_extension);
            $article->eyecatch_path = str_replace('public/','storage/',$path);
        }
        $article->save();

        return json_encode(["status"=>"success","msg"=>"保存に成功しました。","redirect"=>""]);
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