import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import PostsIndex from './views/Posts/PostsIndex.vue';
import PostsAdd from './views/Posts/PostsAdd.vue';
import PostsEdit from './views/Posts/PostsEdit.vue';
import PostsView from './views/Posts/PostsView.vue';
import PageNotFound from './views/PageNotFound.vue';
import profile from './views/Profile/Profile.vue';
import Informes from './views/Informes.vue';
import DetalleInforme from './views/DetalleInforme.vue';
import crearInforme from './views/Informes/CrearInforme.vue';

export const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'root',
            component: Home
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/posts',
            name: 'posts',
            component: PostsIndex
        },
        {
            path: '/informes',
            name: 'informes',
            component: Informes
        },
        {
            path: '/detalleInforme',
            name: 'detalleInforme',
            component: DetalleInforme
        },
        {
            path: '/informes/crear',
            name: 'crearInforme',
            component: crearInforme
        },
        {
            path: '/posts/add',
            name: 'addPost',
            component: PostsAdd
        },
        {
            path: '/posts/edit/:id',
            name: 'editPost',
            component: PostsEdit
        },
        {
            path: '/posts/view/:id',
            name: 'viewPost',
            component: PostsView
        },
        {
            path: '/profile',
            name: 'profile',
            component: profile
        },
        {
            path: "*",
            component: PageNotFound
        }
    ],
});
