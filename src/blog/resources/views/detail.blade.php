<html>
    <head>
        <meta charset="utf-8">
        <title>blog詳細</title>
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
                <li><a href="/"><span class="material-icons">home</span>Top</a></li>
                <li><a href="#"><span class="material-icons">new_releases</span>New</a></li>
                <li><a href="#"><span class="material-icons">collections</span>Gallery</a></li>
                <li><a href="#"><span class="material-icons">perm_identity</span>Profile</a></li>
                <li><a href="#"><span class="material-icons">add_ic_call</span>Contact</a></li>
                </ul>
            </nav>
        </header>
        <div class="l-pan">
            <span class="material-icons">home</span> ホーム > テスト
        </div>
        <div class="l-main">  
            <div class="l-content">
                <h1 class="content-title-bottomline">これはテストタイトルです</h1>
                <div class="content-date-and-social">
                    <time datetime="2021-9-19">2021年9月19日</time>
                    <div>
                        <p><img src="{{ asset('img/Twitter_logo.png') }}" alt="Twitter"></p>
                        <p><img src="{{ asset('img/facebook_logo.png') }}" alt="Facebook"></p>
                        <p><img src="{{ asset('img/LINE_logo.png') }}" alt="LINE"></p>
                    </div>
                </div>
                <div class="content-img">
                    <img src="{{ asset('img/puppy.jpg') }}">
                </div>
                <p>
                    こんにちは！<br>
                    これはテスト投稿です。
                    フロントエンジニアに必要だと思うスキルを素人ながら考えていきます。
                </p>
                <div class="content-index">
                    <div class="content-index-title">
                        <img src="{{ asset('img/menu.png') }}" alt="menu"><span>目次</span>
                    </div>
                    <ul class="content-index-list">
                        <li>フロントエンジニアに必要なスキル</li>
                        <li>プログラミング言語だけ学ぶのはよくない</li>
                        <li>お勧めの画像編集ソフト</li>
                    </ul>
                </div>
                <h1 class="content-title-top_bottom_line">フロントエンジニアに必要なスキル</h1>
                <p>
                    僕が考えるには、HTML/CSS/JacaScript/Jqueryあたりは必須で、Vue/react/などの新しい技術も覚えるべき。しかし、言語だけの勉強では一からサイトを作ることが出来ないのは当然。
                </p>
                <h1 class="content-title-top_bottom_line">プログラミング言語だけ学ぶのはよくない</h1>
                <p>
                    サイトを１から作る為にはデザイン、内容、文章力、構成、画像作成などコードを書くより前の作業が非常に多い。コードの練習と共にこれらもざっとやるのがいい。
                </p>
                <p class="content-rel_article">関連記事</p>
                <div class="content-rel_article-flex">
                    <div class="content-rel_article-item">
                        <div><img src="{{ asset('img/fullimage/full1.jpg') }}"></div>
                        <p>美しい夕焼けを見にいこう</p>
                    </div>
                    <div class="content-rel_article-item">
                        <div><img src="{{ asset('img/fullimage/full2.jpg') }}"></div>
                        <p>美しい夕焼けを見にいこう</p>
                    </div>
                    <div class="content-rel_article-item">
                        <div><img src="{{ asset('img/fullimage/full3.jpg') }}"></div>
                        <p>美しい夕焼けを見にいこう</p>
                    </div>
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