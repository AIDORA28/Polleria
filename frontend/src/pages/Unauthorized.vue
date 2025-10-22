<template>
  <div class="min-h-screen bg-gradient-to-br from-brand-primary to-brand-secondary flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-md w-full mx-4">
      <div class="text-center">
        <div class="text-6xl text-red-500 mb-4">🚫</div>
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Acceso No Autorizado</h1>
        <p class="text-gray-600 mb-6">
          No tienes permisos para acceder a esta sección del sistema.
        </p>
        <div class="space-y-3">
          <button 
            @click="goBack"
            class="w-full bg-brand-primary hover:bg-brand-primary/90 text-white font-medium py-2 px-4 rounded-lg transition-colors"
          >
            Volver
          </button>
          <button 
            @click="logout"
            class="w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors"
          >
            Cerrar Sesión
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import auth from '../auth/index.js'

const router = useRouter()

function goBack() {
  router.go(-1)
}

function logout() {
  auth.logout()
  router.push('/login')
}
</script>