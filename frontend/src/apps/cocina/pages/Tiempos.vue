<template>
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Tiempos de Preparación</h2>
      <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Actualizar métricas</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
        <h3 class="text-lg font-semibold mb-2">Tiempo promedio</h3>
        <p class="text-3xl font-bold text-gray-800">{{ metrics.promedio }} min</p>
      </div>
      <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
        <h3 class="text-lg font-semibold mb-2">Pedido más rápido</h3>
        <p class="text-3xl font-bold text-gray-800">{{ metrics.minimo }} min</p>
      </div>
      <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
        <h3 class="text-lg font-semibold mb-2">Pedido más lento</h3>
        <p class="text-3xl font-bold text-gray-800">{{ metrics.maximo }} min</p>
      </div>
    </div>

    <div class="mt-8 bg-white rounded-xl shadow p-6 border border-gray-100">
      <h3 class="text-lg font-semibold mb-4">Distribución de tiempos</h3>
      <ul class="text-sm text-gray-700 list-disc pl-5">
        <li v-for="b in metrics.buckets" :key="b.label">{{ b.label }}: {{ b.count }} pedidos</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import cocinaApi from '../../../api/cocina.js'

const metrics = ref({ promedio: 0, minimo: 0, maximo: 0, buckets: [] })

onMounted(async () => {
  metrics.value = await cocinaApi.fetchTiempos()
})
</script>