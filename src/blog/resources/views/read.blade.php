<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | POST</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    </head>
    <body>
    <a href="/admin">admin</a>
    <div>
        @foreach ($articles as $article)
        <a href="/admin/update/{{ $article['id'] }}">タイトル　：　{{ $article["title"] }}</a>
        <p>本文　:　{{ $article["content"] }}</p>
        <p>画像</p>
        <div><img src="{{ asset($article['eyecatch_path']) }}" width="200"></div>
        @endforeach
    </div>
    </body>
</html>