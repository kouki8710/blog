<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | POST</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <admin-header btnstatus="1"></admin-header>
            <admin-index></admin-index>
        </div>
        <footer class="l-footer">
            <a href="/">ホームページへ移動</a>
        </footer>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>