<template>
<div class="l-admin-content">
    <h2 class="admin-content-title">記事一覧</h2>
    <div class="admin-content">
        <div class="admin-content-item" v-for="article in articles">
            <a :href="article.url">
                <img :src="article.eyecatch_path">
                <p>{{ article.title }}</p>
            </a>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            'articles':[],
        }
    },
    mounted() {
        axios.get("/api/get_all_new_articles").then(response=>{
            let data = response.data;
            this.articles = data.articles;
            let base_path = location.protocol + "//" + location.host;
            this.articles.forEach(article => {
                article.url = base_path + "/admin/update/" + article.id;
            });
        })
    }
}
</script>

<style lang="scss" scoped>
@import "../base/_variavle";

.l-admin-content{
    margin-top: 3rem;
}

.admin-content{
    display: flex;
    flex-wrap:wrap;  
}

.admin-content-title{
    text-align: center;
    margin: 5rem 0 3rem;
    font-size: 4rem;
}

.admin-content-item{
    width: 30%;
    margin: 2rem 1.6%;
    padding: 2rem 0;
    background-color: white;
    a{
        display: block;
        width: 80%;
        margin: auto;
        img {
            display: block;
            width: 100%;
            height: 15rem;
            border: gray solid 1px;
        }
        p{
            margin-top: 2rem;
            font-size: 2rem;
        }
    }
    
}
</style>