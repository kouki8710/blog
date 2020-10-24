<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | POST</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    </head>
    <body>
    <div>
        @foreach ($a as $b)
        <p>{{ $b["content"] }}</p>
        @endforeach
    </div>

        <form action="/create" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div>
            <p>タイトル</p>
            <input type="text" name="title">
            </div>
            <div>
            <p>本文</p>
            <textarea name="body"></textarea>
            </div>
            <div>
            <p>アイキャッチ画像</p>
            <input type="file" name="image">
            </div>
            <input type="submit" value="送信">
        </form>

    </body>
</html>