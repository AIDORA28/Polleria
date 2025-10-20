import { createRouter, createWebHistory } from 'vue-router';

const Home = () => import('../pages/Home.vue');
const Mesas = () => import('../pages/Mesas.vue');
const Insumos = () => import('../pages/Insumos.vue');
const Pedidos = () => import('../pages/Pedidos.vue');
const Dashboard = () => import('../pages/Dashboard.vue'); // CORRECTO

export const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', name: 'home', component: Home },
    { path: '/mesas', name: 'mesas', component: Mesas },
    { path: '/insumos', name: 'insumos', component: Insumos },
    { path: '/pedidos', name: 'pedidos', component: Pedidos },
    { path: '/dashboard', name: 'dashboard', component: Dashboard }, // CORRECTO
  ],
});
