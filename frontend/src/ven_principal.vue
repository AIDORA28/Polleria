<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-400 p-4 shadow-md flex justify-between items-center">
      <h1 class="text-white text-xl font-bold">🍗 Sistema Pollería - Ventana Principal</h1>
      <button
        @click="logout"
        class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg font-medium transition-colors"
      >
        Cerrar Sesión
      </button>
    </header>

    <!-- Contenido -->
    <main class="p-6 max-w-6xl mx-auto">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Panel de Accesos</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <button
          v-for="app in apps"
          :key="app.name"
          @click="goTo(app.path)"
          class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 flex flex-col items-center justify-center gap-3 border border-gray-100"
        >
          <div class="text-3xl">{{ app.icon }}</div>
          <span class="text-gray-800 font-semibold">{{ app.label }}</span>
        </button>
      </div>
    </main>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import auth from './auth/index.js'

const router = useRouter()

// Lista de aplicaciones con sus rutas
const apps = [
  { name: 'almacenero', label: 'Almacenero', path: '/almacenero', icon: '📦' },
  { name: 'caja', label: 'Caja', path: '/caja', icon: '💰' },
  { name: 'cocina', label: 'Cocina', path: '/cocina', icon: '🍳' },
  { name: 'delivery', label: 'Delivery', path: '/delivery', icon: '🏍️' },
  { name: 'meseros', label: 'Meseros', path: '/meseros', icon: '🧑‍🍳' },
  { name: 'owner', label: 'Owner', path: '/owner', icon: '👑' }
]

function goTo(path) {
  router.push(path)
}

function logout() {
  auth.logout()
  router.push('/login')
}
</script>

<style scoped>
/* Opcional: ajustes de hover para iconos */
button:hover div {
  transform: scale(1.1);
  transition: transform 0.2s;
}
</style>
