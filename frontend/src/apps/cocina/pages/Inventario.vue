<template>
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Inventario de Cocina</h2>
      <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">Solicitar reposición</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="item in inventario" :key="item.id" class="bg-white rounded-xl shadow p-4 border border-gray-100">
        <div class="flex justify-between items-center mb-2">
          <h3 class="text-lg font-semibold">{{ item.nombre }}</h3>
          <span :class="badgeClass(item)" class="text-xs px-2 py-1 rounded border">{{ item.estado }}</span>
        </div>
        <p class="text-sm text-gray-600 mb-2">Stock: {{ item.stock }}</p>
        <p class="text-sm text-gray-600 mb-4">Unidad: {{ item.unidad }}</p>
        <div class="flex gap-2">
          <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">Detalle</button>
          <button class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Ajustar stock</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import cocinaApi from '../../../api/cocina.js'

const inventario = ref([])

onMounted(async () => {
  inventario.value = await cocinaApi.fetchInventario()
})

function badgeClass(item) {
  if (item.estado === 'Crítico') return 'bg-red-100 text-red-800 border-red-200'
  if (item.estado === 'Bajo') return 'bg-yellow-100 text-yellow-800 border-yellow-200'
  return 'bg-green-100 text-green-800 border-green-200'
}
</script>