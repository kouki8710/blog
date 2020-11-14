<template>
    <header class="l-header">
        <div class="header-title">
            <h1 class="header-title-text">K.Blog</h1>
        </div>
        <nav class="header-nav">
            <ul>
            <li><a href="/"><span class="material-icons">home</span>Top</a></li>
            <li><a href="/new"><span class="material-icons">new_releases</span>New</a></li>
            <li><a href="/making"><span class="material-icons">menu_book</span>Category</a></li>
            <!-- <li><a href="/profile"><span class="material-icons">perm_identity</span>Profile</a></li> -->
            <!-- <li><a href="/admin"><span class="material-icons">settings</span>Admin</a></li> -->
            </ul>
        </nav>
    </header>
</template>

<script>

</script>

<style lang="scss" scoped>
@import "../base/_variavle";

.l-header{
    background-color: white;
}

.header-title{
    display: flex;
    justify-content: center;
}

.header-title-logo{
    width: 4rem;
}

.header-title-text{
    font-family: 'Monotype Corsiva';
    margin: 3rem 5rem;
    font-size: 3rem;
}

.header-nav{
    border-top: 1px solid black;
    border-bottom: 1px solid black;
}

.header-nav ul{
    display: flex;
    justify-content: center;
    li{
        width: 20%;
        text-align: center;
        border-right: 1px solid black;
        border-left: 1px solid black;
        height: 4rem;
        line-height: 4rem;
        transition: all 300ms 0s ease;
        a{
            display: block;
            width: 100%;
            height: 100%;
            font-size: 1.2rem;
        }
        &:hover{
            background: $base_color_lightblue;
            color: white;
        }
    }

    li + li{
        border-left: none;
    }

    .material-icons{
        margin-right: 1rem;
    }
    
}

</style>


<style lang="scss">
@import "../base/_variavle";

.header-nav ul{
    li{
        @include mq(){
            .material-icons{
                display: none!important;
            }
        }
    }
}

</style>