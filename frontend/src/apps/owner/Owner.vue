<template>
  <div class="min-h-screen bg-gray-50">
    <!-- TopBar -->
    <div class="bg-gradient-to-r from-brand-primary to-brand-secondary shadow-lg">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-white">🍗 Sistema Owner - Gestión Principal</h1>
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
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Panel de Control</h2>
          <p class="text-gray-600">Gestiona todos los aspectos de tu restaurante desde aquí</p>
        </div>

        <!-- Grid de Tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Inventario -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Inventario</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Gestiona productos, stock y proveedores</p>
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Acceder
            </button>
          </div>

          <!-- Personal -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Personal</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Administra empleados, horarios y roles</p>
            <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Acceder
            </button>
          </div>

          <!-- Reportes -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Reportes</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Análisis de ventas y estadísticas</p>
            <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Acceder
            </button>
          </div>

          <!-- Configuración -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-gray-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Configuración</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Ajustes del sistema y restaurante</p>
            <button class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Acceder
            </button>
          </div>

          <!-- Finanzas -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-yellow-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Finanzas</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Control de ingresos y gastos</p>
            <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Acceder
            </button>
          </div>

          <!-- Menú -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-red-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Menú</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Gestiona platos, precios y categorías</p>
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Acceder
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