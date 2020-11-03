<template>
<div class="l-content">
    <h1 class="content-title-bottomline">{{ article.title }}</h1>
    <div class="content-date-and-social">
        <time datetime="2021-9-19"></time>
        <div>
            <p><img src="/img/Twitter_logo.png" alt="Twitter"></p>
            <p><img src="/img/facebook_logo.png" alt="Facebook"></p>
            <p><img src="/img/LINE_logo.png" alt="LINE"></p>
        </div>
    </div>
    <div class="content-img" v-if="article.eyecatch_path != 'storage/eyecatch/no-image.png'">
        <img :src="create_imageURL(article.eyecatch_path)">
    </div>
    <div class="content-markdown" v-html="article.content"></div>

    <p class="content-rel_article">関連記事</p>
    <div class="content-rel_article-flex">
        <div class="content-rel_article-item">
            <div><img src="/img/fullimage/full1.jpg"></div>
            <p>美しい夕焼けを見にいこう</p>
        </div>
        <div class="content-rel_article-item">
            <div><img src="/img/fullimage/full2.jpg"></div>
            <p>美しい夕焼けを見にいこう</p>
        </div>
        <div class="content-rel_article-item">
            <div><img src="/img/fullimage/full3.jpg"></div>
            <p>美しい夕焼けを見にいこう</p>
        </div>
    </div>
</div>
</template>

<script>

export default {
    data() {
        return {
            article : '',
        }
    },
    mounted() {
        let path = location.pathname;
        let article_id = path.split("/").slice(-1)[0];
        axios.get("/api/get_article/"+article_id).then(response=>{
            this.article = response.data;
        }).catch(response=>{
            console.log(response);
        })
    },
    methods : {
        create_imageURL(imageURL){
            return "/" + imageURL;
        }
    }
}
</script>

<style lang="scss">
@import "../base/_variavle";

.l-content{
    width: 60%;
    margin: 3rem 5%;
}

.l-content{
    background-color: white;
    padding: 2rem 3rem;
    margin-bottom: 10rem;
    border-radius: 10px;

    p{
        font-size: 1.3rem;
        line-height: 2.6rem;
    }
    li{
        font-size: 1.3rem;
    }

    .content-title-bottomline{
        font-size: 3rem;
        padding: 2rem 0;
        border-bottom: 5px solid $base_color_lightblue;
    }

    .content-date-and-social{
        display: flex;
        margin-top: 2rem;
        time{
            width: 50%;
            font-size: 1.2rem;
            color: gray;
            padding-left: 1rem;
        }
        div{
            width: 50%;
            display: flex;
            justify-content: flex-end;
            img {
                margin: 0 0.5rem;
                width: 2rem;
                border-radius: 10px;
            }
        }
    }

    .content-img{
        margin: 2rem 0;
        img{
            width: 100%;
        }   
    }
    
    
    .content-rel_article{
        text-align: center;
        margin: 4rem 0;
        padding: 2rem;
        font-size: 2rem;
        background-color: #D7D7D7;
    }

    .content-rel_article-flex{
        display: flex;

        .content-rel_article-item{
            width: 30%;
            margin: 2rem 3%;
            img{
                width: 100%;
            }
            p{
                margin-top: 1rem;
                font-size: 1.5rem;
                font-weight: bold;
                line-height: 2rem;
            }
        }
    }
}


.content-markdown{
    .content-title-top_bottom_line,h1,h2{
        position: relative;
        font-size: 1.8rem;
        padding: 1rem 0;
        margin: 6rem 0 3rem;
        background-color: $base_color_lightblue;
        color: white;
        text-align: center;
        &::before{
            content: "";
            position: absolute;
            display: block;
            height: 5px;
            width: 100%;
            top: -10px;
            left: 0;
            background-color: $base_color_lightblue;
        }
        &::after{
            position: absolute;
            content: "";
            display: block;
            height: 5px;
            width: 100%;
            bottom: -10px;
            left: 0;
            background-color: $base_color_lightblue;
        }
    }

    p{
        line-height: 2.5rem;
    }

    pre {
        width: 100%;
        padding: 1rem;
        background: #364549;
        color: white;
        font-size: 1.2rem;
        overflow-x: scroll;
    }

    .content-index{
        padding: 2rem 2rem 1rem;
        margin: 3rem 0;
        border-radius: 10px;
        background-color: $base_color_gray;
        .content-index-title{
            font-size: 2rem;
            img {
                width: 3rem;
                margin-right: 3rem;
                vertical-align: middle;
            }
            span{
                vertical-align: middle;
            }
        }

        .content-index-list{
            margin: 2rem;
            list-style: disc;
            li{
                padding: 1rem 0;
            }
        }
    }
}
</style>