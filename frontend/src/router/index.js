import { createRouter, createWebHistory } from 'vue-router'
import auth from '../auth/index.js'

// ================================
// Importaciones lazy de páginas principales
// ================================
const Login = () => import('../pages/Login.vue')
const Unauthorized = () => import('../pages/Unauthorized.vue')
const VenPrincipal = () => import('../ven_principal.vue')

// ================================
// Importaciones lazy de aplicaciones por rol
// ================================
const Owner = () => import('../apps/owner/Owner.vue')
const Caja = () => import('../apps/caja/Caja.vue')
const Cocina = () => import('../apps/cocina/Cocina.vue')
const Meseros = () => import('../apps/meseros/Meseros.vue')
const Delivery = () => import('../apps/delivery/Delivery.vue')
const Almacenero = () => import('../apps/almacenero/Almacenero.vue')

// ================================
// Guards de autenticación y rol
// ================================
function requireAuth(to, from, next) {
  if (!auth.isLoggedIn()) {
    next('/login')
  } else {
    next()
  }
}

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

// ================================
// Rutas
// ================================
const routes = [
  // Redirección inicial
  { path: '/', redirect: '/login' },

  // Páginas principales
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { requiresGuest: true }
  },
  { path: '/unauthorized', name: 'unauthorized', component: Unauthorized },
  { path: '/ven-principal', name: 'ven-principal', component: VenPrincipal, beforeEnter: requireAuth },

  // Rutas por rol
  { path: '/owner', name: 'owner', component: Owner, beforeEnter: requireRole('owner') },
  { path: '/caja', name: 'caja', component: Caja, beforeEnter: requireRole('caja') },
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
      { path: 'historial', name: 'cocina-historial', component: () => import('../apps/cocina/pages/Historial.vue') }
    ]
  },
  { path: '/meseros', name: 'meseros', component: Meseros, beforeEnter: requireRole('mesero') },
  { path: '/delivery', name: 'delivery', component: Delivery, beforeEnter: requireRole('delivery') },
  { path: '/almacenero', name: 'almacenero', component: Almacenero, beforeEnter: requireRole('almacenero') }
]

// ================================
// Configuración del router
// ================================
const router = createRouter({
  history: createWebHistory(),
  routes
})

// ================================
// Guard global para usuarios invitados
// ================================
router.beforeEach((to, from, next) => {
  if (to.meta.requiresGuest && auth.isLoggedIn()) {
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
