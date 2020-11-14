<template>
<div class="l-admin-markdown">
    <transition>
        <div class="admin-markdown-sideR" v-show="is_sideshow">
            <div class="admin-markdown-side-inner">
                <div class="admin-markdown-side-inner-close"><button @click="is_sideshow=!is_sideshow">✖</button></div>
                
                <div class="admin-markdown-side-inner-eyecatch">
                    <h2>アイキャッチ画像</h2>
                    <div v-show="show_option_eyecatch">
                        <label class="admin-markdown-eyecatch">
                        画像を選択
                        <input type="file" name="image" @change='update_eyecatch'>
                        </label>
                        <p>画像</p>
                        <div><img class="image-preview"></div>
                    </div>
                    
                </div>
                <div class="admin-markdown-side-inner-open">
                    <h2>公開設定</h2>
                    <div class="select-wrap">
                        <select v-model='is_open'>
                            <option value="public" selected>公開</option>
                            <option value="private">非公開</option>
                        </select>
                    </div>
                </div>

                <div class="admin-markdown-side-inner-tag">
                    <h2>タグ設定</h2>
                    <input type="text" autocomplete="on" list="admin-tag" v-model="input_tag_name">
                    <datalist id="admin-tag">
                        <option v-for="tag in all_tag_list" :value="tag.name">{{tag.name}}</option>
                    </datalist>
                    <button class="side-inner-tag-add-btn" @click="add_tag()">追加</button>
                    <div class="side-inner-selected_tag_list" v-for="tag in selected_tag_list">
                        <span>{{tag.name}}</span>
                        <button @click="delete_tag(tag)">×</button>
                    </div>
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
        <textarea class="form_textarea" placeholder="本文を入力" v-model="body" @input="auto_scroll()"></textarea>
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
                'is_open':'public',
                'all_tag_list': [],
                'selected_tag_list': [],
                'input_tag_name': "",
                'show_option_eyecatch': 1,
            }
        },
        methods: {
            send() {
                let formdata = new FormData();
                formdata.append('title',this.title);
                formdata.append('body',this.markdown);
                formdata.append('image',this.eyecatch);
                formdata.append('row_content',this.body);
                formdata.append('is_open',this.is_open);
                formdata.append('tags',JSON.stringify(this.selected_tag_list));
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
                    
                }).catch(response => {
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

            auto_scroll (){
                let textarea = $("#IDDivHtmlArea");
                let error = 10;
                let threshold = textarea[0].scrollHeight - textarea[0].clientHeight - error;
                if (textarea[0].scrollTop >= threshold){
                    textarea.animate({scrollTop:$("#IDDivHtmlArea")[0].scrollHeight},'fast');
                }
            },

            add_tag (){
                let flag = 1;
                this.all_tag_list.forEach(tag=>{
                    if (tag.name==this.input_tag_name){
                        let is_selected = 0;
                        this.selected_tag_list.forEach(selected_tag=>{
                            if (selected_tag.name==tag.name){
                                is_selected = 1;
                            }
                        });
                        if (is_selected == 1){
                            flag = 2;
                        }else{
                            this.selected_tag_list.push(tag);
                            flag = 0;
                        }
                    }
                });

                switch (flag){
                    case 2:
                        alert("このタグは既に選択されています");
                        break;
                    case 1:
                        alert("このタグは存在しません");
                        break;
                    case 0:
                        break;//成功
                }
                this.input_tag_name = "";
            },

            delete_tag(tag){
                this.selected_tag_list = this.selected_tag_list.filter(t => t!=tag);
            },

        },
        computed: {
            markdown() {
                return  create_index(create_break(marked(this.body)));
            },
        },
        mounted() {
            let path = location.pathname;
            if (path.match(/update\/[0-9]+/)){
                this.article_id = path.split("/").slice(-1)[0];
                axios.get("/api/get_article/"+this.article_id).then(response=>{
                    console.log(response.data);
                    this.title = response.data.title;
                    this.body = response.data.row_content;
                    this.eyecatch_path = response.data.eyecatch_path;
                    this.is_open = response.data.is_open==true ? "public" : "private";
                    this.selected_tag_list = response.data.tags || [];
                    let imageURL = window.location.protocol + '//' + window.location.host + "/" +this.eyecatch_path;
                    $(".image-preview").attr("src",imageURL);
                }).catch(response=>{
                    alert("データ取得中にエラーが発生しました。");
                    console.log(response);
                });
            }else{
                let imageURL = window.location.protocol + '//' + window.location.host + "/" +this.eyecatch_path;
                $(".image-preview").attr("src",imageURL);
            }

            axios.get("/api/get_tags").then(response=>{
                this.all_tag_list = response.data.tags;
            });
            
            marked.setOptions({
                breaks : false,
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
    margin: 2rem 0;
    border: 2px solid orange;
    background: white;
    border-radius: 10px;
    color: black;
    transition: all .3s 0s ease;
    input {
        display: none;
    }
    &:hover{
        cursor: pointer;
        background: orange;
        color: white;
        border: 2px solid white;
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
        background: #e6e6fa;
        border: 2px solid gray;

        h2{
            font-size: 1.5rem;
            border-bottom: black solid 2px;
        }

        .admin-markdown-side-inner-close{
            text-align: right;
            button{
                color: red;
                background: white;
                padding: 0.3rem 0.5rem;
                margin: 1rem 2rem;
                border-radius: 10px;
                font-size: 2rem;
                transition: all .3s 0s ease;
                &:hover{
                    color: white;
                    background: red;
                }
            }
            
        }

        .admin-markdown-side-inner-eyecatch{
            margin: 2rem;

            img{
                width: 100%;
                height: auto;
            }

            p{
                font-size: 1.2rem;
                margin:1rem;
                text-align: center;
            }
        }

        .admin-markdown-side-inner-open{
            margin: 2rem;
            select{
                width: 100%;
                padding: 1rem 2rem;
                background: white;
                color: black;
                z-index: 1;
            }
            .select-wrap{
                position:relative;
                display: inline-block;
                width: 100%;
                margin: 2rem 0;
                border: 2px solid gray;
            }
            .select-wrap::after{
                content: '';
                width: 20px;
                height: 20px;
                border: 0px;
                border-bottom: solid 2px black;
                border-right: solid 2px black;
                -ms-transform: rotate(45deg);
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
                position: absolute;
                top: 20%;
                right: 2rem;
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

.admin-markdown-side-inner-tag{
    width: 80%;
    margin: 2rem auto;
    input {
        background: white;
        padding: 1rem;
        width: 100%;
    }

    .side-inner-tag-add-btn{
        background: yellow;
        padding: 1rem 2rem;
        margin: 1rem;
    }

    .side-inner-selected_tag_list{
        position: relative;
        font-size: 1rem;
        background: white;
        padding: 1rem;
        margin: 1rem 0;
        button{
            position: absolute;
            background: orange;
            color: white;
            padding: 0.5rem 0.7rem;
            right: 1rem;
            top: calc(50% - 1rem);
            &:hover{opacity:0.5;}
        }
    }
}

</style>