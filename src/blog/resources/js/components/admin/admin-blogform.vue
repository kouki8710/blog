<template>
<div class="l-admin-markdown">
    <transition>
        <div class="admin-markdown-sideR" v-show="is_sideshow">
            <div class="admin-markdown-side-inner">
                <div class="admin-markdown-side-inner-close"><button @click="is_sideshow=!is_sideshow">✖</button></div>
                
                <div class="admin-markdown-side-inner-eyecatch">
                    <h2>アイキャッチ画像</h2>
                    <label class="admin-markdown-eyecatch">
                        画像を選択
                        <input type="file" name="image" @change='update_eyecatch'>
                    </label>
                    <p>画像</p>
                    <div><img class="image-preview"></div>
                </div>
                <div class="admin-markdown-side-inner-open">
                    <h2>公開設定</h2>
                    <select v-model='is_open'>
                        <option value="open" selected>公開</option>
                        <option value="unopen">非公開</option>
                    </select>
                </div>
            </div>
        </div>
    </transition>
    
    <div class="admin-markdown-title">
        <p>タイトル</p>
        <input type="text" name="title" placeholder="タイトルを入力" autocomplete="off" v-model='title'>
    </div>
    <div class="admin-markdown-icon">
        <button class="admin-markdown-icon-setting" @click="is_sideshow=!is_sideshow"><span class="material-icons">settings</span></button>
    </div>
    <div class="admin-markdown-container">
        <div class="admin-markdown-textarea">
        <textarea class="form_textarea" placeholder="本文を入力" v-model="body"></textarea>
        </div>
        <div id="IDDivHtmlArea" class="admin-markdown-content content-markdown" v-html='markdown'></div>
    </div>
    <div class="admin-markdown-container-btn">
        <button class="admin-markdown-delete-btn" v-if="article_id!=''" @click="delete_article">Delete</button>
        <button class="admin-markdown-save-btn" @click="send()">Save</button>
    </div>
    
</div>
</template>

<script>
    import marked from 'marked';
    import hljs from 'highlightjs';

    function create_index(str){
        str = str.replace(/@index/,(match)=>{
            let index_text = "";
            console.log(str);
            console.log("ue");
            str.match(/<h2.*?>.*?<\/h2>/g).forEach((match)=>{
                index_text += "<li>"+match.replace(/^<h2.*?>/,"").replace(/<\/h2>$/,"")+"</li>";
            });
            let changed_str = `<div class='content-index'>
            <div class="content-index-title"><img src="/img/menu.png" alt="menu"><span>目次</span></div><ul class="content-index-list">`+index_text+`</ul></div>`;
            return changed_str;
        });
        return str;
    }

    function create_break(str){
        str = str.replace(/(\r\n|\n|\r)/g,"<br>");
        return str;
    }

    export default {
        data() {
            return {
                'title': '',
                'body': '',
                'article_id': '',
                'eyecatch':null,
                'eyecatch_path':'storage/eyecatch/no-image.png',
                'is_sideshow':false,
                'is_open':'',
            }
        },
        methods: {
            send() {
                let formdata = new FormData();
                formdata.append('title',this.title);
                formdata.append('body',create_index(marked(this.body)));
                formdata.append('image',this.eyecatch);
                formdata.append('row_content',this.body);
                formdata.append('is_open',this.is_open);
                let config = {
                    "header": {
                        'content-type': 'multipart/form-data',
                    }
                }
                let url = "";
                if (this.article_id != ''){
                    url = '/api/update/' + this.article_id;
                }else{
                    url = '/api/create';
                }
                axios.post(url, formdata,config)
                .then(response => {
                    if (response.data.status == "success"){
                        alert(response.data.msg);
                        if (response.data.redirect){
                            location = response.data.redirect;
                        }
                    }else if(response.data.status == 0){
                        alert(response.data.msg);
                    }
                    
                }).catch(response=> {
                    alert("保存に失敗しました。");
                });
            },
            update_eyecatch(e) {
                this.eyecatch = e.target.files[0];
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector(".image-preview").setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            },
            delete_article() {
                let ret = confirm("この記事を削除します。本当によろしいですか？");
                if (ret == true){
                    axios.post("/api/delete/"+this.article_id).then((response)=>{
                        if (response.data.status=="success"){
                            alert(response.data.msg);
                            location = response.data.redirect;
                        }else{
                            alert("削除に失敗しました。");
                        }
                    }).catch(response => {
                        alert("削除に失敗しました。");
                    })
                }
            },
        },
        computed: {
            markdown() {
                return  create_index(marked(this.body));
            },
        },
        mounted() {
            let path = location.pathname;
            if (path.match(/update\/[0-9]+/)){
                this.article_id = path.split("/").slice(-1)[0];
                axios.get("/api/get_article/"+this.article_id).then(response=>{
                    this.title = response.data.title;
                    this.body = response.data.row_content;
                    this.eyecatch_path = response.data.eyecatch_path;
                    let imageURL = window.location.protocol + '//' + window.location.host + "/" +this.eyecatch_path;
                    $(".image-preview").attr("src",imageURL);
                    console.log(response.data);
                }).catch(response=>{
                    alert("データ取得中にエラーが発生しました。");
                    console.log(response);
                });
            }else{
                let imageURL = window.location.protocol + '//' + window.location.host + "/" +this.eyecatch_path;
                $(".image-preview").attr("src",imageURL);
            }
            
            marked.setOptions({
                breaks : true,
                langPrefix: '',
                highlight: function(code, lang) {
                    return hljs.highlightAuto(code, [lang]).value;
                }
            });
        }
    }
</script>

<style src='highlightjs/styles/night-owl.css'></style>

<style lang="scss" scoped>
@import "../base/_variavle";

.admin-markdown-title{
    width: 80%;
    margin: auto;
    p{
        font-size: 2rem;
        padding: 2rem 2rem 1rem;
    }
    input{
        background: white;
        width: 100%;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        border-radius: 10px; 
        border: 2px solid #ddd;
        &:focus{
            border: 2px solid $base_color_lightblue; 
        }
    }
}
.l-admin-markdown{
    position: relative;
    .admin-markdown-container{
        display: flex;
        margin-top: 1rem;

        .admin-markdown-textarea{
            width: 50%;
            height: 60vh;
            background: white;
            textarea{
                height: 100%;
                width: 100%;
                padding: 1rem;
                font-size: 1.1rem;
                border-radius: 10px; 
                border: 2px solid #ddd;
                &:focus{
                    border: 2px solid $base_color_lightblue; 
                }
            }
        }
        .admin-markdown-content{
            background: white;
            height: 60vh;
            width: 50%;
            border: gray solid 2px;
            padding: 1rem;
            font-size: 1.1rem;
            border-radius: 10px; 
            border: 2px solid #ddd;
            overflow: scroll;
            p{

            }
        }
    } 
}

.admin-markdown-container-btn{
    text-align: right;
    margin: 0 3rem 4rem;
}

.admin-markdown-save-btn{
    height: 5rem;
    margin: 2rem;
    padding: 0 3em;
    background: orange;
    font-size: 2rem;
    color: #FFF;
    border-bottom: solid 4px #627295;
    border-radius: 3px;
    &:hover{
        opacity: 0.5;
    }
    &:active{
        -webkit-transform: translateY(4px);
        transform: translateY(4px);
        border-bottom: none;
    }
}

.admin-markdown-delete-btn{
    height: 5rem;
    margin: 2rem;
    padding: 0 2em;
    background: red;
    font-size: 2rem;
    color: #FFF;
    border-bottom: solid 4px #627295;
    border-radius: 3px;
    &:hover{
        opacity: 0.5;
    }
    &:active{
        -webkit-transform: translateY(4px);
        transform: translateY(4px);
        border-bottom: none;
    }
}

.admin-markdown-eyecatch{
    display: block;
    width: 60%;
    padding: 1rem 2rem;
    margin: 2rem 1rem;
    background: orange; 
    border-radius: 10px;
    color: white;
    input {
        display: none;
    }
    &:hover{
        cursor: pointer;
    }
}

.admin-markdown-sideR {
    z-index: 99;
    position: fixed;
    top: 0;
    right: 0;
    width: 20%;
    height: 100vh;
    color: black;
    font-size: 16px;
    .admin-markdown-side-inner {
        height: 100%;
        overflow: auto;
        overflow-x: hidden;
        background: #0DCEA8;
        .admin-markdown-side-inner-close{
            text-align: right;
            button{
                color: red;
                background: white;
                padding: 0.3rem 0.5rem;
                margin: 1rem 2rem 1rem 0;
                border-radius: 10px;
                font-size: 2rem;
            }
            
        }

        .admin-markdown-side-inner-eyecatch{
            margin: 2rem;

            h2{
                font-size: 1.5rem;
                border-bottom: black solid 2px;
            }

            img{
                width: 100%;
            }

            p{
                font-size: 1.2rem;
                margin:1rem;
                text-align: center;
            }
        }
    }
}

.admin-markdown-icon{
    .admin-markdown-icon-setting{
        margin: 2rem 3rem 0 45%;
        transition-duration: 0.5s;
        span{
            font-size: 3rem;
        }
        
    }
    .admin-markdown-icon-setting:hover{
        transform: rotate(60deg);
    }
}

.admin-markdown-side-inner-open{

}

</style>