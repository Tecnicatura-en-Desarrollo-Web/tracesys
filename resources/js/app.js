import Vue from 'vue';
import { BootstrapVue, BootstrapVueIcons, IconsPlugin } from 'bootstrap-vue';
import VueTippy, { TippyComponent } from "vue-tippy";
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import Notifications from 'vue-notification';
import { routes } from './routes';
import App from './views/App.vue';
import VueSession from "vue-session";
Vue.use(VueSession);
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import 'sweetalert2/dist/sweetalert2.min.css';
import { normalizeUnits, now } from 'moment';
import Multiselect from 'vue-multiselect';
import loader from "vue-ui-preloader";

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.use(VueSweetalert2);
Vue.use(Notifications);
Vue.use(Vuex);
Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);
Vue.use(IconsPlugin);
Vue.use(VueTippy);
Vue.use(loader);
Vue.component('multiselect', Multiselect);
Vue.component('app', App);

const router = Vue.use(VueRouter);
const boostrapvue = Vue.use(BootstrapVue);
const store = new Vuex.Store({
    state: {
        idComentario: null
    },
    mutations: {
        actualizarIdComentario(state, n) {
            state.idComentario = n
        },

    }
})
const app = new Vue({
    el: '#app',
    components: {
        App
    },
    store: store,
    router: routes,
    loader:loader
});
