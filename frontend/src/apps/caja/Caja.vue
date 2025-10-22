<template>
  <div class="min-h-screen bg-gray-50">
    <!-- TopBar -->
    <div class="bg-gradient-to-r from-brand-primary to-brand-secondary shadow-lg">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-white">💰 Sistema Caja - Punto de Venta</h1>
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
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Panel de Caja</h2>
          <p class="text-gray-600">Gestiona cobros, pagos y cierre de caja</p>
        </div>

        <!-- Grid de Funcionalidades -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
            <p class="text-gray-600 text-sm mb-4">Ver pedidos listos para cobrar</p>
            <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Pedidos
            </button>
          </div>

          <!-- Registrar Pagos -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Registrar Pagos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Procesar pagos por diferentes métodos</p>
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Procesar Pago
            </button>
          </div>

          <!-- Cierre de Caja -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Cierre de Caja</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Arqueo y cierre de caja diario</p>
            <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Cerrar Caja
            </button>
          </div>

          <!-- Historial de Ventas -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-yellow-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Historial</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Consultar ventas anteriores</p>
            <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Ver Historial
            </button>
          </div>

          <!-- Reportes de Caja -->
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-100">
            <div class="flex items-center mb-4">
              <div class="bg-red-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-gray-800 ml-3">Reportes</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Generar reportes de caja</p>
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Generar Reporte
            </button>
          </div>

          <!-- Configuración de Caja -->
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
            <p class="text-gray-600 text-sm mb-4">Ajustes de caja y métodos de pago</p>
            <button class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
              Configurar
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