<template>
  <div class="min-h-screen bg-gray-50">
    <!-- TopBar -->
    <div class="bg-gradient-to-r from-brand-primary to-brand-secondary shadow-lg">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-white">👨‍🍳 Sistema Cocina - Gestión de Pedidos</h1>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-white/90 text-sm">{{ user?.username }}</span>
            <button 
              @click="logout"
              class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors text-sm font-medium"
            >
              Cerrar Sesión
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Contenido Principal -->
    <div class="p-6">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Panel de Cocina</h2>
          <p class="text-gray-600">Gestiona pedidos, preparación y tiempos de cocina</p>
        </div>

        <!-- Subnavbar del módulo -->
        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
          <nav class="flex flex-wrap gap-2 p-3">
            <RouterLink :to="{ name: 'cocina-pedidos' }" class="px-3 py-2 rounded-lg text-sm font-medium"
              :class="$route.name === 'cocina-pedidos' ? 'bg-orange-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'">
              Pedidos
            </RouterLink>
            <RouterLink :to="{ name: 'cocina-preparacion' }" class="px-3 py-2 rounded-lg text-sm font-medium"
              :class="$route.name === 'cocina-preparacion' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'">
              Preparación
            </RouterLink>
            <RouterLink :to="{ name: 'cocina-listos' }" class="px-3 py-2 rounded-lg text-sm font-medium"
              :class="$route.name === 'cocina-listos' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'">
              Listos
            </RouterLink>
            <RouterLink :to="{ name: 'cocina-recetas' }" class="px-3 py-2 rounded-lg text-sm font-medium"
              :class="$route.name === 'cocina-recetas' ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'">
              Recetas
            </RouterLink>
            <RouterLink :to="{ name: 'cocina-inventario' }" class="px-3 py-2 rounded-lg text-sm font-medium"
              :class="$route.name === 'cocina-inventario' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'">
              Inventario
            </RouterLink>
            <RouterLink :to="{ name: 'cocina-tiempos' }" class="px-3 py-2 rounded-lg text-sm font-medium"
              :class="$route.name === 'cocina-tiempos' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'">
              Tiempos
            </RouterLink>
            <RouterLink :to="{ name: 'cocina-historial' }" class="px-3 py-2 rounded-lg text-sm font-medium"
              :class="$route.name === 'cocina-historial' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'">
              Historial
            </RouterLink>
          </nav>
        </div>

        <!-- Grid de Funcionalidades -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Pedidos Pendientes -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-orange-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Pedidos Pendientes</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Ver pedidos por preparar</p>
            <button @click="$router.push({ name: 'cocina-pedidos' })" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Cola de Pedidos
            </button>
          </div>

          <!-- En Preparación -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">En Preparación</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Pedidos actualmente en cocina</p>
            <button @click="$router.push({ name: 'cocina-preparacion' })" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver en Proceso
            </button>
          </div>

          <!-- Pedidos Listos -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Pedidos Listos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Platos terminados para servir</p>
            <button @click="$router.push({ name: 'cocina-listos' })" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Listos
            </button>
          </div>

          <!-- Recetas -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Recetas</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Consultar recetas y preparaciones</p>
            <button @click="$router.push({ name: 'cocina-recetas' })" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Recetas
            </button>
          </div>

          <!-- Inventario de Cocina -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-yellow-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Inventario</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Stock de ingredientes disponibles</p>
            <button @click="$router.push({ name: 'cocina-inventario' })" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Stock
            </button>
          </div>

          <!-- Tiempos de Preparación -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-red-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Tiempos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Estadísticas de tiempos de cocina</p>
            <button @click="$router.push({ name: 'cocina-tiempos' })" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Estadísticas
            </button>
          </div>
        </div>

        <!-- Contenido de subrutas -->
        <div class="mt-8">
          <RouterView />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import auth from '../../auth/index.js'

const user = computed(() => auth.getCurrentUser())

function logout() {
  auth.logout()
  window.close()
}
</script>