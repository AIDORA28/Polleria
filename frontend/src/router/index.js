import { createRouter, createWebHistory } from 'vue-router'
import auth from '../auth/index.js'

// Importaciones lazy de páginas principales
const Login = () => import('../pages/Login.vue')

// Importaciones lazy de aplicaciones por rol
const Owner = () => import('../apps/owner/Owner.vue')
const Caja = () => import('../apps/caja/Caja.vue')
const Cocina = () => import('../apps/cocina/Cocina.vue')
const Meseros = () => import('../apps/meseros/Meseros.vue')
const Delivery = () => import('../apps/delivery/Delivery.vue')
const Almacenero = () => import('../apps/almacenero/Almacenero.vue')

// Guard de autenticación
function requireAuth(to, from, next) {
  if (!auth.isLoggedIn()) {
    next('/login')
  } else {
    next()
  }
}

// Guard de rol específico
function requireRole(role) {
  return function(to, from, next) {
    if (!auth.isLoggedIn()) {
      next('/login')
    } else if (!auth.hasRole(role)) {
      next('/unauthorized')
    } else {
      next()
    }
  }
}

const routes = [
  {
    path: '/',
    redirect: '/login'
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { requiresGuest: true }
  },
  {
    path: '/unauthorized',
    name: 'unauthorized',
    component: () => import('../pages/Unauthorized.vue')
  },
  // Rutas por rol - cada una abre en nueva ventana
  {
    path: '/owner',
    name: 'owner',
    component: Owner,
    beforeEnter: requireRole('owner')
  },
  {
    path: '/caja',
    name: 'caja', 
    component: Caja,
    beforeEnter: requireRole('caja')
  },
  {
    path: '/cocina',
    name: 'cocina',
    component: Cocina,
    beforeEnter: requireRole('cocinero'),
    redirect: '/cocina/pedidos',
    children: [
      { path: 'pedidos', name: 'cocina-pedidos', component: () => import('../apps/cocina/pages/Pedidos.vue') },
      { path: 'preparacion', name: 'cocina-preparacion', component: () => import('../apps/cocina/pages/Preparacion.vue') },
      { path: 'listos', name: 'cocina-listos', component: () => import('../apps/cocina/pages/Listos.vue') },
      { path: 'recetas', name: 'cocina-recetas', component: () => import('../apps/cocina/pages/Recetas.vue') },
      { path: 'inventario', name: 'cocina-inventario', component: () => import('../apps/cocina/pages/Inventario.vue') },
      { path: 'tiempos', name: 'cocina-tiempos', component: () => import('../apps/cocina/pages/Tiempos.vue') },
      { path: 'historial', name: 'cocina-historial', component: () => import('../apps/cocina/pages/Historial.vue') },
    ]
  },
  {
    path: '/meseros',
    name: 'meseros',
    component: Meseros,
    beforeEnter: requireRole('mesero')
  },
  {
    path: '/delivery',
    name: 'delivery',
    component: Delivery,
    beforeEnter: requireRole('delivery')
  },
  {
    path: '/almacenero',
    name: 'almacenero',
    component: Almacenero,
    beforeEnter: requireRole('almacenero')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Guard global para rutas que requieren invitado (no autenticado)
router.beforeEach((to, from, next) => {
  if (to.meta.requiresGuest && auth.isLoggedIn()) {
    // Si está logueado y trata de ir a login, redirigir según su rol
    const user = auth.getCurrentUser()
    if (user && user.role) {
      next(`/${user.role}`)
    } else {
      next('/')
    }
  } else {
    next()
  }
})

export default router
