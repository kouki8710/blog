<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | update</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    </head>
    <body>
    <a href="/admin">admin</a>
    @if (isset($msg))
    <p>エラーメッセージ</p>
    <p>{{ $msg }}</p>
    @endif
    <div>
        <form action="/admin/update/{{ $article['id'] }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div>
                <p>タイトル</p>
                <input type="text" name="title" value="{{ $article['title'] }}">
            </div>
            <div>
                <p>本文</p>
                <textarea name="body">{{ $article["content"] }}</textarea>
            </div>
            <div>
                <p>eyecatch</p>
                <input type="file" name="image"><br>
                <img src="{{ asset($article['eyecatch_path']) }}" width="300">
            </div>
            <input type="submit" value="update">
        </form>
        <form action="/admin/delete/{{ $article['id'] }}" method="POST">
            @csrf
            <input type="submit" value="delete">
        </form>
    </div>
    </body>
</html>