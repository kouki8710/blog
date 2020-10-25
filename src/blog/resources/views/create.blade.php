<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | POST</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    </head>
    <body>
    @if (isset($msg))
    <p>{{ $msg }}</p>
    @endif
    <a href="/admin">admin</a>
    <form action="/admin/create" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
        <p>タイトル</p>
        <input type="text" name="title">
        </div>
        <div>
        <p>本文</p>
        <textarea class="form_textarea" cols="30" rows="20"></textarea>
        <input type="hidden" name="body" class="hidden"> 
        </div>
        <div>
        <p>アイキャッチ画像</p>
        <input type="file" name="image">
        </div>
        <input type="submit" value="送信">
    </form>
    <div id="IDDivHtmlArea"></div>
    <script src="{{ asset('js/create.js') }}"></script>
    </body>
</html>