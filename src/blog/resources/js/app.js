/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('admin-blogform', require('./components/admin/admin-blogform.vue').default);
// Vue.component('admin-header', require('./components/admin/admin-header.vue').default);
// Vue.component('admin-index', require('./components/admin/admin-index.vue').default);
// Vue.component('blog-header', require('./components/blog/blog-header.vue').default);
// Vue.component('blog-footer', require('./components/blog/blog-footer.vue').default);
// Vue.component('blog-home-content', require('./components/blog/blog-home-content.vue').default);
// Vue.component('blog-sidebar', require('./components/blog/blog-sidebar.vue').default);
// Vue.component('blog-main-two', require('./components/blog/blog-main-two.vue').default);
// Vue.component('blog-detail-content', require('./components/blog/blog-detail-content.vue').default);
// Vue.component('blog-making', require('./components/blog/blog-making.vue').default);
// Vue.component('blog-main-one', require('./components/blog/blog-main-one.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
