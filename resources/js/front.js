require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

//import Vue from 'vue';
import App from './views/App';
import router from './router';
import axios from 'axios';

const app = new Vue({
  el: '#root',
  render: h => h(App),
  router
});