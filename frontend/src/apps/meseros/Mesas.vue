<template>
  <div class="min-h-screen bg-gray-50 p-6">
    <header class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Mesas Disponibles</h1>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <div
        v-for="mesa in mesas"
        :key="mesa.id"
        class="bg-white rounded-lg shadow p-6 flex flex-col items-center justify-between hover:shadow-lg transition"
      >
        <div class="text-xl font-semibold text-gray-700">Mesa {{ mesa.numero }}</div>
        <div class="mt-4">
          <span
            class="px-3 py-1 rounded-full text-sm font-medium"
            :class="mesa.estado === 'ocupada' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'"
          >
            {{ mesa.estado }}
          </span>
        </div>
        <button
          @click="irAMesa(mesa.numero)"
          class="mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
          Abrir Mesa
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

// Datos de ejemplo de mesas
const mesas = [
  { id: 1, numero: 1, estado: 'disponible' },
  { id: 2, numero: 2, estado: 'ocupada' },
  { id: 3, numero: 3, estado: 'disponible' },
  { id: 4, numero: 4, estado: 'disponible' },
  { id: 5, numero: 5, estado: 'ocupada' },
]

const router = useRouter()

function irAMesa(numero) {
  router.push(`/mesas_${numero}`)
}
</script>

<style scoped>
/* opcional: estilos adicionales */
</style>
