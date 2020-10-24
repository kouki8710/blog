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
        <form action="/create" method="POST">
            {{ csrf_field() }}
            <input type="text" name="title">
            <textarea name="body"></textarea>
            <input type="submit" value="送信">
        </form>
    </body>
</html>