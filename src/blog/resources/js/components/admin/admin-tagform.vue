<template>
<div class="admin-tag">
    <div>
    <p>作成するタグの名前</p>
        <input type="text" name="tag_name" class="admin-tag-input"
         autocomplete="off" v-model="tag_name">
    </div>
    <button class="admin-tag-create-btn" @click="send()">submit</button>
    <div class="tag-list">
        <h2>タグ一覧</h2>
        <div class="tag-list-item" v-for="tag in tag_list">
            <span>・{{ tag['name'] }}</span>
            <button @click="delete_tag(tag)">×</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            "tag_name":"",
            "tag_list":[],
        }
    },
    methods: {
        send() {
            let formdata = new FormData();
            formdata.append("name",this.tag_name);
            axios.post("/api/create_tag",formdata).then(response => {
                if (response.data.status == 'success'){
                    alert("保存に成功しました");
                    this.tag_name = "";
                    this.tag_list.push(response.data.tag);
                }else{
                    alert("保存に失敗しました");
                }
            })
        },
        delete_tag(tag) {
            axios.post("/api/delete_tag/"+tag.id).then(response=>{
                if (response.data.status == 'success'){
                    alert("削除に成功しました");
                    this.tag_list = this.tag_list.filter(n => n!=tag);
                }else{
                    alert("削除に失敗しました");
                }
            });
        },
    },
    mounted() {
        axios.get("/api/get_tags").then(response => {
            this.tag_list = response.data.tags;
        });
    },
}
</script>

<style lang="scss" scoped>
@import "../base/_variavle";

.admin-tag{
    width: 80%;
    padding: 2rem;
    margin: 3rem auto;
    .admin-tag-input{
        width: 50%;
        padding: 1rem;
        border: 1px solid black;
        background: white;
    }

    .admin-tag-create-btn{
        height: 3rem;
        margin: 1rem;
        padding: 0 2em;
        background: orange;
        
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

    .tag-list{
        background: white;
        padding: 2rem;

        h2{
            font-size: 3rem;
        }

        .tag-list-item{
            font-size: 2rem;
            padding: 1rem;

            span{
                margin: 0 4rem;
            }

            button{
                background: red;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 1rem;

                &:hover{
                    opacity: 0.5;
                }
            }
        }
    }
}

</style>