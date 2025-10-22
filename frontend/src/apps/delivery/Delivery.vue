<template>
  <div class="min-h-screen bg-gray-50">
    <!-- TopBar -->
    <div class="bg-gradient-to-r from-brand-primary to-brand-secondary shadow-lg">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-white">🚚 Sistema Delivery - Entregas</h1>
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
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Panel de Delivery</h2>
          <p class="text-gray-600">Gestiona entregas, rutas y seguimiento de pedidos</p>
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
            <p class="text-gray-600 text-sm mb-4">Pedidos listos para entrega</p>
            <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Pendientes
            </button>
          </div>

          <!-- En Ruta -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">En Ruta</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Pedidos en proceso de entrega</p>
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver En Ruta
            </button>
          </div>

          <!-- Mapa de Rutas -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Mapa de Rutas</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Optimizar rutas de entrega</p>
            <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Mapa
            </button>
          </div>

          <!-- Historial de Entregas -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Historial</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Entregas completadas</p>
            <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Historial
            </button>
          </div>

          <!-- Estado del Vehículo -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-yellow-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Estado Vehículo</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Mantenimiento y combustible</p>
            <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Estado
            </button>
          </div>

          <!-- Reportes -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-red-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Reportes</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Estadísticas de entregas</p>
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Reportes
            </button>
          </div>
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