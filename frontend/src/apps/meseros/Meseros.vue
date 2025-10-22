<template>
  <div class="min-h-screen bg-gray-50">
    <!-- TopBar -->
    <div class="bg-gradient-to-r from-brand-primary to-brand-secondary shadow-lg">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-white">🍽️ Sistema Meseros - Atención al Cliente</h1>
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
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Panel de Meseros</h2>
          <p class="text-gray-600">Gestiona mesas, pedidos y atención al cliente</p>
        </div>

        <!-- Grid de Funcionalidades -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Estado de Mesas -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v2z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Estado de Mesas</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Ver disponibilidad y ocupación</p>
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Mesas
            </button>
          </div>

          <!-- Tomar Pedidos -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Tomar Pedidos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Registrar nuevos pedidos</p>
            <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Nuevo Pedido
            </button>
          </div>

          <!-- Pedidos Activos -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-orange-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Pedidos Activos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Seguimiento de pedidos en proceso</p>
            <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Pedidos
            </button>
          </div>

          <!-- Menú del Día -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Menú del Día</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Consultar platos y precios</p>
            <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Menú
            </button>
          </div>

          <!-- Servir Platos -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-yellow-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Servir Platos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Platos listos para servir</p>
            <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Listos
            </button>
          </div>

          <!-- Cuenta y Facturación -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-red-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Cuenta</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Generar cuenta para cobro</p>
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Generar Cuenta
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