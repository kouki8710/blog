<template>
<div class="l-content-home">
    <div class="content-home-recommend">
        <span><span class="material-icons">new_releases</span>新規記事</span>
    </div>
    <div class="content-home-rel_article-flex">
        <a class="content-home-rel_article-item" v-for="article in articles" :href="article.url" >
            <img :src="article.eyecatch_path">
            <p>{{ article.title }}</p>
        </a>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            'articles' : [],
        }
    },

    mounted() {
        axios.get("/api/get_all_public_new_articles").then(response=>{
            let data = response.data;
            this.articles = data.articles;
            let base_path = location.protocol + "//" + location.host;
            this.articles.forEach(article => {
                article.url = base_path + "/detail/" + article.id;
            });
        })
    },
}
</script>

<style lang="scss" scoped>
@import "../base/_variavle";

.l-content-home{
    width: 60%;
    margin: 3rem 5%;
}

.content-home-recommend{
    font-size: 2rem;
    position: relative;
    text-align: center;
    .material-icons{
        margin-right: 1rem;
    }
    > span{
        position: relative;
        display: inline-block;
        padding: 2rem;
    }
}

.content-home-rel_article-flex{
    display: flex;
    flex-wrap: wrap;

    .content-home-rel_article-item{
        display: block;
        width: 46%;
        margin: 2rem 2% 0 2%;
        padding: 1rem;
        background-color: white;
        border-radius: 10px;
        transition: all 300ms 0s ease;
        img {
            display: block;
            width: 100%;
            height: 15rem;
            border: 1px #7e7e7e solid;
            border-radius: 10px;
        }
        p{
            margin-top: 1rem;
            padding: 1rem;
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 2rem;
        }

        &:hover{
            background: $base_color_lightblue;
            color: white;
        }
    }
}
</style>