<template>
  <!-- Render sin shell para login -->
  <router-view v-if="isLogin" />

  <!-- Shell general para el resto -->
  <div v-else class="min-h-screen bg-gray-50">
    <!-- Header básico -->
    <header class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-gradient-to-r from-brand-primary to-brand-secondary flex items-center justify-center text-white text-sm">🍗</div>
          <h1 class="text-lg font-semibold text-gray-800">Sistema Pollería</h1>
        </div>
        <div class="flex items-center gap-4">
          <router-link to="/" class="text-sm font-medium text-brand-primary hover:text-brand-primary/80">Inicio</router-link>

          <!-- Botón para ir a la ventana principal -->
          <router-link 
            to="/ven-principal" 
            class="text-sm font-medium text-white bg-brand-primary hover:bg-brand-primary/80 px-3 py-1 rounded"
          >
            Ventana Principal
          </router-link>

          <span v-if="isMock" class="inline-flex items-center text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-800 border border-yellow-200">Mock</span>
        </div>
      </div>
    </header>

    <!-- Contenido -->
    <main class="py-6">
      <router-view />
    </main>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import auth from './auth/index.js'

const route = useRoute()
const isLogin = computed(() => route.name === 'login')
const isMock = computed(() => auth.isMockAuth)
</script>

