<template>
<div class="l-admin-markdown">
    <div class="admin-markdown-title">
        <p>タイトル</p>
        <input type="text" name="title" placeholder="タイトルを入力" autocomplete="off" v-model='title'>
    </div>
    <div>
        <p>アイキャッチ画像</p>
        <input type="file" name="image" @change='update_eyecatch'>
    </div>
    <div class="admin-markdown-container">
        <div class="admin-markdown-textarea">
        <textarea class="form_textarea" placeholder="本文を入力" v-model="body"></textarea>
        </div>
        <div id="IDDivHtmlArea" class="admin-markdown-content content-markdown" v-html='markdown'></div>
    </div>
    <div class="admin-markdown-container-btn">
        <button class="admin-markdown-save-btn" @click="send()">Save</button>
    </div>
    
</div>
</template>

<script>
    marked.setOptions({breaks : true});

    function create_index(str){
        str = str.replace(/@index/,(match)=>{
            console.log(match);
            let index_text = "";
            document.querySelectorAll("h2").forEach((el)=>{
                index_text+="<li>"+el.textContent+"</li>"
            });
            let changed_str = `<div class='content-index'>
            <div class="content-index-title"><img src="/img/menu.png" alt="menu"><span>目次</span></div><ul class="content-index-list">`+index_text+`</ul></div>`;
            return changed_str;
        });
        return str;
    }

    export default {
        data() {
            return {
                'title': '',
                'body': '',
                'eyecatch':null,
            }
        },
        methods: {
            send() {
                let formdata = new FormData();
                formdata.append('title',this.title);
                formdata.append('body',create_index(marked(this.body)));
                formdata.append('image',this.eyecatch);
                let config = {
                    "header": {
                        'content-type': 'multipart/form-data',
                    }
                }
                axios.post('/admin/create', formdata,config)
                .then(response => {
                    if (response.data.status == "success"){
                        alert(response.data.msg);
                        location = response.data.redirect;
                    }else if(response.data.status == 0){
                        alert(response.data.msg);
                    }
                    
                }).catch(response=> {
                    alert("保存に失敗しました。");
                });
            },
            update_eyecatch(e) {
                this.eyecatch = e.target.files[0];
            }
        },
        computed: {
            markdown() {
                return  create_index(marked(this.body));
            }
        }
    }
</script>

<style lang="scss">
$base_color_lightblue : #3AABD2;
$base_color_gray : #F0F0F0;
$base_color_blue : #6A86E6;

.admin-markdown-title{
    width: 80%;
    margin: auto;
    p{
        font-size: 2rem;
        padding: 2rem 2rem 1rem;
    }
    input{
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
    .admin-markdown-container{
        display: flex;
        margin-top: 3rem;

        .admin-markdown-textarea{
            width: 50%;
            height: 60vh;
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
            height: 60vh;
            width: 50%;
            border: gray solid 2px;
            padding: 1rem;
            font-size: 1.1rem;
            border-radius: 10px; 
            border: 2px solid #ddd;
            overflow: scroll;
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

</style>