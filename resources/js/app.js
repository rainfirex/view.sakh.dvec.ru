import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate';
import store from './app/store';
import router from './app/router';
import App from "./app/App";

import 'bootstrap/scss/bootstrap.scss';

import 'bootstrap4-toggle/css/bootstrap4-toggle.min.css';

import './app/assets/scss/main.scss';

window.Vue = require('vue');

require('./bootstrap');

Vue.use(VueRouter);
Vue.use(Vuelidate);

const app = new Vue({
    el: '#app',
    store,
    router,
    render : h => h(App)
});
