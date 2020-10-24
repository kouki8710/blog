<html>
    <head>
        <meta charset="utf-8">
        <title>K.Blog | 日々のプログラミング学習記録</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <header class="l-header">
            <div class="header-title">
                <img src="{{ asset('img/pen.svg') }}" alt="pen" class="header-title-logo">
                <h1 class="header-title-text">K.Blog</h1>
                <img src="{{ asset('img/pen.svg') }}" alt="pen" class="header-title-logo">
            </div>
            <nav class="header-nav">
                <ul>
                <li><a href="#"><span class="material-icons">home</span>Top</a></li>
                <li><a href="#"><span class="material-icons">new_releases</span>New</a></li>
                <li><a href="#"><span class="material-icons">collections</span>Gallery</a></li>
                <li><a href="#"><span class="material-icons">perm_identity</span>Profile</a></li>
                <li><a href="#"><span class="material-icons">add_ic_call</span>Contact</a></li>
                </ul>
            </nav>
        </header>
        <!-- <div class="l-pan">
            <span class="material-icons">home</span> ホーム
        </div> -->
        <div class="l-main">
            <div class="l-content-home">
                <div class="content-home-recommend">
                    <span><span class="material-icons">trending_up</span>おすすめの記事</span>
                </div>
                <div class="content-home-rel_article-flex">
                    <a class="content-home-rel_article-item" href="#">
                        <img src="{{ asset('img/fullimage/full1.jpg') }}">
                        <p>美しい夕焼けを見にいこう</p>
                    </a>
                    <a class="content-home-rel_article-item" href="#">
                        <img src="{{ asset('img/fullimage/full2.jpg') }}">
                        <p>美しい夕焼けを見にいこう</p>
                    </a>
                    <a class="content-home-rel_article-item" href="#">
                        <img src="{{ asset('img/fullimage/full3.jpg') }}">
                        <p>美しい夕焼けを見にいこう</p>
                    </a>
                </div>
            </div>
            <div class="l-sidebar">
                <div class="sidebar-explain">
                    <p>K.Blogについて</p>
                    <div class="sidebar-explain-content">
                        <img src="{{ asset('img/icon.png') }}" alt="icon">
                        <div>このブログは僕がプログラミングの学習中に理解した内容を大雑把に書いていきます。</div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="l-footer">
            <p>© Copyright 2020 K.Bolg All rights reserved.</p>
        </footer>
    </body>
</html>