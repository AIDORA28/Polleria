<template>
  <div class="min-h-screen bg-gray-50">
    <!-- TopBar -->
    <div class="bg-gradient-to-r from-brand-primary to-brand-secondary shadow-lg">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-white">📦 Sistema Almacenero - Gestión de Inventario</h1>
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
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Panel de Almacén</h2>
          <p class="text-gray-600">Gestiona inventario, stock y reposición de productos</p>
        </div>

        <!-- Grid de Funcionalidades -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Inventario Actual -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Inventario Actual</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Consultar stock disponible</p>
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Inventario
            </button>
          </div>

          <!-- Reposición de Stock -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Reposición</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Registrar entrada de productos</p>
            <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Reponer Stock
            </button>
          </div>

          <!-- Alertas de Stock Bajo -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-red-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Alertas de Stock</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Productos con stock bajo</p>
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Alertas
            </button>
          </div>

          <!-- Movimientos de Inventario -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Movimientos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Historial de entradas y salidas</p>
            <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Movimientos
            </button>
          </div>

          <!-- Proveedores -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-yellow-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Proveedores</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Gestionar proveedores y pedidos</p>
            <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Proveedores
            </button>
          </div>

          <!-- Reportes de Almacén -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-gray-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Reportes</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Generar reportes de inventario</p>
            <button class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Generar Reporte
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