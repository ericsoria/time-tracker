require('./bootstrap');

import Vue from 'vue'

import store from './store/index'
import App from './views/App'

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

const app = new Vue({
    el: '#app',
    components: { App },
    store
});
