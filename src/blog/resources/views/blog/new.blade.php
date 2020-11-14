<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | Home</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
    <div id="app">
        <blog-header></blog-header>
        <blog-main-two>
            <template v-slot:blog-content>
                <blog-new-content />
            </template>
            <template v-slot:blog-sidebar>
                <blog-sidebar />
            </template>
        </blog-main-two>
        <blog-footer></blog-footer>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>