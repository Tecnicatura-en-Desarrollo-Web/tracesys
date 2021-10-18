import Vue from 'vue';
import Vuex from 'vuex'
import VueRouter from 'vue-router';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import Notifications from 'vue-notification';
import { routes } from './routes';
import App from './views/App.vue';
import Header from './components/Header.vue';
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.use(VueSweetalert2);
Vue.use(Notifications);
Vue.use(Vuex);

Vue.component('app', App);

const router = Vue.use(VueRouter);
const store = new Vuex.Store({
    state: {
        nombre: 'jona'
    }
})
const app = new Vue({
    el: '#app',
    components: {
        App
        // 'top-header': Header
    },
    store: store,
    router: routes
});
