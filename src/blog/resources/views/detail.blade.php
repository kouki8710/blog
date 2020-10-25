@extends("base.base")

@section("title",$article["title"])

@section("content")
<div class="l-content">
    <h1 class="content-title-bottomline">{{ $article["title"] }}</h1>
    <div class="content-date-and-social">
        <time datetime="2021-9-19">{{ $article["updated_at"]->format("Y年m月d日") }}</time>
        <div>
            <p><img src="{{ asset('img/Twitter_logo.png') }}" alt="Twitter"></p>
            <p><img src="{{ asset('img/facebook_logo.png') }}" alt="Facebook"></p>
            <p><img src="{{ asset('img/LINE_logo.png') }}" alt="LINE"></p>
        </div>
    </div>
    @if ($article['eyecatch_path'] != "storage/eyecatch/no-image.png")
    <div class="content-img">
        <!-- <img src="{{ asset('img/puppy.jpg') }}"> -->
        <img src="{{ asset($article['eyecatch_path']) }}">
    </div>
    @endif
    <div class="content-markdown">
        <p>
            こんにちは！<br>
            これはテスト投稿です。
            フロントエンジニアに必要だと思うスキルを素人ながら考えていきます。
        </p>
        <div class="content-index">
            <div class="content-index-title">
                <img src="{{ asset('img/menu.png') }}" alt="menu"><span>目次</span>
            </div>
            <ul class="content-index-list">
                <li>フロントエンジニアに必要なスキル</li>
                <li>プログラミング言語だけ学ぶのはよくない</li>
                <li>お勧めの画像編集ソフト</li>
            </ul>
        </div>
        <h1 class="content-title-top_bottom_line">フロントエンジニアに必要なスキル</h1>
        <p>
            僕が考えるには、HTML/CSS/JacaScript/Jqueryあたりは必須で、Vue/react/などの新しい技術も覚えるべき。しかし、言語だけの勉強では一からサイトを作ることが出来ないのは当然。
        </p>
        <h1 class="content-title-top_bottom_line">プログラミング言語だけ学ぶのはよくない</h1>
        <p>
            サイトを１から作る為にはデザイン、内容、文章力、構成、画像作成などコードを書くより前の作業が非常に多い。コードの練習と共にこれらもざっとやるのがいい。
        </p>
    </div>
    <div class="content-markdown">
        {!! $article["content"] !!}
    </div>
    


    <p class="content-rel_article">関連記事</p>
    <div class="content-rel_article-flex">
        <div class="content-rel_article-item">
            <div><img src="{{ asset('img/fullimage/full1.jpg') }}"></div>
            <p>美しい夕焼けを見にいこう</p>
        </div>
        <div class="content-rel_article-item">
            <div><img src="{{ asset('img/fullimage/full2.jpg') }}"></div>
            <p>美しい夕焼けを見にいこう</p>
        </div>
        <div class="content-rel_article-item">
            <div><img src="{{ asset('img/fullimage/full3.jpg') }}"></div>
            <p>美しい夕焼けを見にいこう</p>
        </div>
    </div>
</div>
@endsection