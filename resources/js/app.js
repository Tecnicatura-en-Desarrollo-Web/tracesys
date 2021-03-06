import Vue from 'vue';
import VueTippy, { TippyComponent } from "vue-tippy";
import { BootstrapVue, BootstrapVueIcons, IconsPlugin } from 'bootstrap-vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import swal from 'sweetalert2';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

window.swal = swal;
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
import VueApexCharts from 'vue-apexcharts'
import icons from "v-svg-icons";


window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.use(VueApexCharts);
Vue.component("icon", icons);
Vue.use(VueSweetalert2);
Vue.use(Notifications);
Vue.use(Vuex);
Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);
Vue.use(IconsPlugin);
Vue.use(VueTippy);
Vue.use(loader);
Vue.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 1,
    newestOnTop: true
  });

Vue.component('multiselect', Multiselect);
Vue.component('app', App);
Vue.component("tippy", TippyComponent);

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
    loader: loader
});

