<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | POST</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    </head>
    <body>
        <div id="app">
            <admin-header btnstatus="1"></admin-header>
        </div>
        
        <div class="l-admin-content">
            <h2 class="admin-content-title">記事一覧</h2>
            <div class="admin-content">
                @foreach ($articles as $article)
                <div class="admin-content-item">
                    <a href="/admin/update/{{ $article['id'] }}">
                        <img src="{{ asset($article['eyecatch_path']) }}">
                        <p>{{ $article["title"] }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <footer class="l-footer">
            <a href="/">ホームページへ移動</a>
        </footer>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>