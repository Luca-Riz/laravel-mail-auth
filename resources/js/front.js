/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 
 window.axios = require('axios');
 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
 
//  axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
 
 
 import App from './views/App';
 import router from './router';

 const app = new Vue({
     el: '#root',
     render: h => h(App),
     router
 });