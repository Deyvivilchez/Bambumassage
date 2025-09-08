const Inicio = () => import ('./components/Inicio.vue');
//const categoria = () => import ('./components/servicios/Categoria.vue');
import categoriaBambu from './components/servicios/Categoria.vue'
const productoservicios = () =>  import ('./components/servicios/Producto.vue');
const portadas = () => import ('./components/servicios/Portadas.vue');
import Eventos from './components/servicios/Eventos.vue'
import FaqAdmin from './components/servicios/FaqAdmin.vue'

//importamos los demas componenetes
export const routes = [
    {
        name: 'inicio',
        path: '/inicio',
        component: Inicio
    },
    {
        name: '/categoria_bambu',
        path: '/categoria_bambu',
        component: categoriaBambu,
    },
    {
        name: 'productoservicios',
        path: '/productoservicios',
        component: productoservicios,
    },
    {
        name: 'portadaSlider',
        path: '/portadaSlider',
        component: portadas,

    },
    {
        name: 'Eventos',
        path: '/Eventos',
        component: Eventos,
    },
    {
        name: 'FaqAdmin',
        path: '/FaqAdmin',
        component: FaqAdmin,
    },
];
