require('./bootstrap');
import '@mdi/font/css/materialdesignicons.min.css'; // ✅ Iconos MDI

window.Swal = require('sweetalert2')
import vue from 'vue'
window.Vue = vue;

import App from './components/App.vue';

//importamos Axios
import VueAxios from 'vue-axios';
import axios from 'axios';
import Paginacion from "./components/Paginacion.vue";
//Importamos y configuramos el Vue-router
import VueRouter from 'vue-router';
import { routes } from './routes';
import FaqChat from './components/servicios/FaqChat.vue';
import VueQuillEditor from 'vue-quill-editor'
// Opcional: estilos predeterminados
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

Vue.component('faq-chat', FaqChat);
Vue.use(VueQuillEditor).component("paginacion", Paginacion)
Vue.use(VueRouter);
Vue.use(VueAxios, axios);




const router = new VueRouter({
    mode: 'history',
    routes: routes
});

//finalmente, definimos nuestra app de Vue
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
