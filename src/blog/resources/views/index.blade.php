@extends("base.base")

@section("title","日々のプログラミング学習記録")

@section("content")
<div class="l-content-home">
<div class="content-home-recommend">
    <span><span class="material-icons">trending_up</span>おすすめの記事</span>
</div>
<div class="content-home-rel_article-flex">
    @foreach ($articles as $article)
    <a class="content-home-rel_article-item" href="/detail/{{ $article['id'] }}">
        <img src="{{ asset($article['eyecatch_path']) }}">
        <p>{{ $article["title"] }}</p>
    </a>
    @endforeach
</div>
</div>
@endsection