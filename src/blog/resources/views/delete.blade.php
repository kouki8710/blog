<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | POST</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    </head>
    <body>
    @if (isset($msg))
    <p>{{ $msg }}</p>
    @endif
    <p>削除する</p>
    <div>
    @csrf
        @foreach ($articles as $article)
        <form action="/admin/delete/{{ $article['id'] }}" method="POST">
        <p>タイトル　：　{{ $article["title"] }</p>
        <p>本文　:　{{ $article["content"] }}</p>
        <div><img src="{{ asset($article['eyecatch_path']) }}" width="200"></div>
        <input type="submit" value="delete">
        </form>
        @endforeach
    </div>
    </body>
</html>