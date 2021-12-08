import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import PostsIndex from './views/Posts/PostsIndex.vue';
import PostsAdd from './views/Posts/PostsAdd.vue';
import PostsEdit from './views/Posts/PostsEdit.vue';
import PostsView from './views/Posts/PostsView.vue';
import PageNotFound from './views/PageNotFound.vue';
import profile from './views/Profile/Profile.vue';
import Informes from './views/Informes/Informes.vue';
import DetalleInforme from './views/Informes/DetalleInforme.vue';
import crearInforme from './views/Informes/CrearInforme.vue';
import register from './views/Register/Register.vue';
import crearSector from './views/Sector/CrearSector.vue';
import verSectores from './views/Sector/VerSectores.vue';
import login from './views/Register/Login.vue';
import activacion from './views/Register/Activacion.vue';
import Suggestion from './views/Suggestion/CrearSuggestion.vue';
import CrearProveedor from './views/Provider/CrearProveedor.vue';
import SolicitarRepuesto from './views/Provider/SolicitarRepuesto.vue';
import Replacement from './views/Replacement/Replacements.vue';
import app from './views/App.vue';

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
            path: '/reports',
            name: 'reports',
            component: Informes
        },
        // {
        //     path: '/detalleInforme',
        //     name: 'detalleInforme',
        //     component: DetalleInforme
        // },
        {
            path: '/detalleInforme/:id',
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
            path: '/register',
            name: 'register',
            component: register
        },
        {
            path: '/login',
            name: 'login',
            component: login
        },
        {
            path: '/sector/crear',
            name: 'crearSector',
            component: crearSector,
        },
        {
            path: '/sector/ver',
            name: 'verSectores',
            component: verSectores,
        },
        // {
        //     path: '/app',
        //     name: 'app',
        //     component: app
        // },
        ,
        {
            path: '/activacion/:user_id',
            name: 'activacion',
            component: activacion
        },
        {
            path: '/suggestion/crear',
            name: 'Suggestion',
            component: Suggestion,
        },
        {
            path: '/proveedor/crear',
            name: 'CrearProveedor',
            component: CrearProveedor,
        },
        {
            path: '/proveedor/solicitud',
            name: 'SolicitarRepuesto',
            component: SolicitarRepuesto,
        },
        {
            path: '/replacement/replacements',
            name: 'Replacement',
            component: Replacement,
        },
        {
            path: "*",
            component: PageNotFound
        }
    ],
});
