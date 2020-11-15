<template>
<div class="l-sidebar">
    <div class="sidebar-explain">
        <p>K.Blogについて</p>
        <div class="sidebar-explain-content">
            <img src="/img/icon.png" alt="icon">
            <div>このブログは僕がプログラミングの学習中に理解した内容を大雑把に書いていきます。</div>
        </div>
    </div>
</div>
</template>

<script>

</script>

<style lang="scss" scoped>
@import "../base/_variavle";

.l-sidebar{
    width: 25%;
    margin: 5rem 5% 3rem 0;
}

.l-sidebar{
    .sidebar-explain{
        background-color: white;
        p{
            height: 4rem;
            background-color: $base_color_lightblue;
            color: white;
            text-align: center;
            line-height: 4rem;
            font-size: 2rem;
        }
        .sidebar-explain-content{
            display: flex;
            img{
                display: block;
                width: 30%;
                height: 30%;
                margin: 2rem 5%;
            }
            div{
                width: 50%;
                margin: 2rem 5%;
                padding-top: 1.5rem;
                line-height: 2rem;
            }
        }
    }
}
</style>

<style lang="scss">
@import "../base/_variavle";

.l-sidebar{
    @include mq(){
        width: 90%!important;
        margin: 5rem 5% 3rem!important;
    }
}
</style>