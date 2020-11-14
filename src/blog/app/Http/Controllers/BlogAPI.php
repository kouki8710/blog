<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\article;
use App\Models\tag;
use App\Models\article_tag;
use Illuminate\Support\Facades\Log;

class BlogAPI extends Controller
{
    //新規記事全て取得
    public function get_all_new_articles()
    {
        $articles = article::orderby('created_at','desc')->get();
        return json_encode(compact("articles"));
    }

    //公開している新規記事取得
    public function get_all_public_new_articles()
    {
        $articles = article::where("is_open",1)->orderby('created_at','desc')->get();
        return json_encode(compact("articles"));
    }

    //お勧めの記事取得
    public function get_all_recommend_articles()
    {
        $articles = article::where("is_open",1)->orderby('pv','desc')->get();
        return json_encode(compact("articles"));
    }

    //特定の記事取得
    public function get_article($id){
        $article = article::find($id);
        if (!$article) return \App::abort(404);
        $article->pv += 1;
        $article->save();
        $article->tags = $article->tags()->get();
        return json_encode($article);
    }

    //関係記事取得
    public function get_relative_articles($id)
    {
        $articles = article::where('id','!=',$id)->orderby("created_at","desc")->take(3)->get();
        return json_encode(compact("articles"));
    }

    //記事削除
    public function delete($id)
    {
        $article = article::find($id);
        if (!$article) return \App::abort(404);
        article_tag::where("article_id",$article->id)->delete();
        $article->delete();
        return json_encode(["status"=>"success","msg"=>"削除に成功しました","redirect"=>"/admin/"]);
    }

    //記事作成_POST
    public function create_post(Request $request)
    {
        $title = $_POST["title"];
        $content = $_POST["body"];
        $row_content = $_POST["row_content"];
        $is_open = $_POST["is_open"];
        $tags = json_decode($_POST["tags"]);

        if (!$title or !$content){
            $msg = "タイトルと本文を入力してください。";
            $status = 0;
            return json_encode(compact("msg","status"));
        }

        $article = new article();
        $article->title = $title;
        $article->content = $content;
        $article->row_content = $row_content;
        $article->is_open = $is_open=="public" ? true : false;
        if ($request->file("image")){
            $file_extension = pathinfo($request->file('image')->getClientOriginalName())["extension"];
            $path = $request->file("image")->storeas("public/eyecatch",UuidV4Factory::generate(). ".". $file_extension);
            $article->eyecatch_path = str_replace('public/','storage/',$path);
        }
        $article->save();
        foreach ($tags as $tag){
            if ( tag::find($tag->id)->exists() ){
                article_tag::create(["article_id"=>$article->id,"tag_id"=>$tag->id]);
            }
            
        }

        return json_encode(["status"=>"success","msg"=>"保存に成功しました。","redirect"=>"/admin/"]);
    }

    //記事更新
    public function update_post($id,Request $request)
    {
        $title = $_POST["title"];
        $content = $_POST["body"];
        $row_content = $_POST["row_content"];
        $is_open = $_POST["is_open"];
        $tags = json_decode($_POST["tags"]);

        if (!$title or !$content){
            $msg = "タイトルと本文を入力してください。";
            $article = article::find($id);
            return json_encode(compact("msg"));
        }


        $article = article::find($id);
        $article->title = $title;
        $article->content = $content;
        $article->row_content = $row_content;
        $article->is_open = $is_open=="public" ? true : false;
        if ($request->file("image")){
            $file_extension = pathinfo($request->file('image')->getClientOriginalName())["extension"];
            $path = $request->file("image")->storeas("public/eyecatch",UuidV4Factory::generate(). ".". $file_extension);
            $article->eyecatch_path = str_replace('public/','storage/',$path);
        }
        $article->save();
        //既存の関係削除
        article_tag::where("article_id", $article->id)->delete();
        //新しい関係の作成
        foreach ($tags as $tag){

            if ( tag::find($tag->id)->exists() ){
                article_tag::create(["article_id"=>$article->id,"tag_id"=>$tag->id]);
            }

        }

        return json_encode(["status"=>"success","msg"=>"保存に成功しました。","redirect"=>""]);
    }

    

    //タグ作成
    public function create_tag(Request $request)
    {
        $tag = tag::create($request->all());
        return json_encode(["status"=>"success","tag"=>$tag]);
    }

    //タグ全取得
    public function get_tags()
    {
        $tags = tag::all();
        return json_encode(compact("tags"));
    }

    //タグ削除
    public function delete_tag($id)
    {
        $tag = tag::find($id);
        if ($tag){
            $tag->delete();
            return json_encode(["status"=>"success"]);
        }else{
            return json_encode(["status"=>"error"]);
        }
    }

}

//UUID作成
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