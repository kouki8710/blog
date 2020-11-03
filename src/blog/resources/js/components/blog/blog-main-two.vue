<template>
<div class="l-main">
    <slot name="blog-content"></slot>
    <slot name="blog-sidebar"></slot>
</div>
</template>

<script>

</script>

<style lang="scss" scoped>
@import "../base/_variavle";

.l-main{
    display: flex;
}
</style>