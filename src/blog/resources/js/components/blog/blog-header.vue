<template>
    <header class="l-header">
        <div class="header-title">
            <h1 class="header-title-text">K.Blog</h1>
        </div>
        <nav class="header-nav">
            <ul>
            <li><a href="/"><span class="material-icons">home</span>Top</a></li>
            <li><a href="/making"><span class="material-icons">new_releases</span>New</a></li>
            <li><a href="/making"><span class="material-icons">collections</span>Gallery</a></li>
            <li><a href="/making"><span class="material-icons">perm_identity</span>Profile</a></li>
            <li><a href="/making"><span class="material-icons">add_ic_call</span>Contact</a></li>
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

.header-nav ul{
    display: flex;
    justify-content: center;
    li{
        width: 20%;
        text-align: center;
        border: 1px solid black;
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
    .material-icons{
        margin-right: 1rem;
    }
    
}
</style>