<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | update</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
    
    <div id="app">
        <admin-header btnstatus="1"></admin-header>
        <admin-blogform></admin-blogform>
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>