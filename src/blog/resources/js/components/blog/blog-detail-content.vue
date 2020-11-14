<template>
<div class="l-content">
    <h1 class="content-title-bottomline">{{ article.title }}</h1>
    <div class="content-tag-list">
        <a class="content-tag-item" v-for="tag in article.tags" href="#">{{tag.name}}</a>
    </div>
    <div class="content-date-and-social">
        <time v-bind:datetime="format_date(article.updated_at)">{{format_date(article.updated_at)}}</time>
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
        <blog-rel-card v-for="blogRelCard in blogRelCards" 
        :key="blogRelCard.id"
        :article="blogRelCard"></blog-rel-card>
    </div>
</div>
</template>

<script>
import blogrelcard from "./blog-rel-card.vue";

export default {
    components: {
        'blog-rel-card': blogrelcard,
    },
    data() {
        return {
            article : '',
            blogRelCards: [],
        }
    },
    mounted() {
        let path = location.pathname;
        let article_id = path.split("/").slice(-1)[0];
        axios.get("/api/get_article/"+article_id).then(response=>{
            this.article = response.data;
        }).catch(response=>{
            console.log(response);
        });
        axios.get("/api/get_relative_articles/"+article_id).then(response=>{
            this.blogRelCards = response.data.articles;
            this.blogRelCards.forEach(article => {
                article.url = "/detail/" + article.id;
            });
        }).catch(response=>{
            console.log(response);
        });
    },
    methods : {
        create_imageURL(imageURL){
            if (imageURL){
                return "/" + imageURL;
            }else{
                return "";
            }
            
        },
        format_date(date){
            if (date){
                let formated = date.substring(0,10);
                return formated;
            }else{
                return "";
            }
        },
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
        font-size: 2.5rem;
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
    }

    .content-tag-list{
        display: flex;
        flex-wrap: wrap;
        .content-tag-item{
            display: block;
            background: $base_color_lightblue;
            border-radius: 2px;
            margin: 1rem;
            padding: 0.5rem 1rem;
            color: white;
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
        margin: 1rem 0;
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

<style lang="scss">
@import "../base/_variavle";

.l-content{
    @include mq(){
        width: 90%!important;

        .content-rel_article-flex{
            display: block!important;
        }
    }
}
</style>