<template>
<div class="content-rel_article-item">
    <a :href="article.url">
        <div><img :src="create_imageURL(article.eyecatch_path)"></div>
        <p>{{ article.title }}</p>
    </a>
</div>
</template>

<script>
export default {
    props: ["article"], 
    name: "blog-rel-card",
    methods: {
        create_imageURL(imageURL){
            return "/" + imageURL;
        },
    }
}
</script>

<style lang="scss" scoped>
@import "../base/_variavle";

.content-rel_article-item{
    width: 30%;
    margin: 2rem 3%;
    img{
        width: 100%;
        height: 10rem;
        border: 1px solid gray;
    }
    p{
        margin-top: 1rem;
        font-size: 1.5rem;
        font-weight: bold;
        line-height: 2rem;
    }
}
</style>

<style lang="scss">
@import "../base/_variavle";

.content-rel_article-item{
    @include mq(){
        width: 90%!important;
        margin: 2rem 5%!important;
        img{
            height: 15rem!important;
        }
    }
}
</style>