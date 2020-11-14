<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | admin</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <admin-header btnstatus="1"></admin-header>
            <admin-index></admin-index>
            <admin-footer></admin-footer>
        </div>
        
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>