<template>
<header class="l-admin-header">
    <div class="admin-header">
        <h1 class="admin-header-logo"><a href="/admin/">K.blog admin</a></h1>
        <div class="admin-header-container">
            <button class="admin-header-create-btn" onclick="location='/admin/create/'" v-if="btnstatus=='1'">Create</button>
            <button class="admin-header-create-btn" onclick="location='/admin/create/tag'" v-if="btnstatus=='1'">CreateTag</button>
        </div>
    </div>
</header>
</template>

<script>
    export default {
        props : ["btnstatus"],
    }
</script>

<style lang="scss">
@import "../base/_variavle";

.admin-header{
    display: flex;
    background-color: $base_color_blue;
    height: 5rem;

    .admin-header-logo{
        display: inline-block;
        font-family: 'Monotype Corsiva';
        margin: 1rem 2rem;
        font-size: 3rem;
        color: white;
    }
    .admin-header-container{
        margin: 0 3rem 0 auto;
    }
    .admin-header-create-btn{
        height: 3rem;
        margin: 1rem;
        padding: 0 2rem;
        background: orange;/*ボタン色*/
        
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
}
</style>

<style lang="scss">
@import "../base/_variavle";

.admin-header{
    @include mq(){
        .admin-header-logo{
            font-size: 2rem!important;
        }
        .admin-header-create-btn{
            padding: 0 1rem!important;
        }

        .admin-header-container{
            margin: 0 1rem 0 auto!important;
        }
    }
}
</style>