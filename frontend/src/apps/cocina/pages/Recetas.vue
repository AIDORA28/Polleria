<template>
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Recetas</h2>
      <input v-model="query" placeholder="Buscar receta..." class="border rounded-lg px-3 py-2 w-64" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="receta in filtered" :key="receta.id" class="bg-white rounded-xl shadow p-4 border border-gray-100">
        <h3 class="text-lg font-semibold mb-2">{{ receta.nombre }}</h3>
        <p class="text-sm text-gray-600 mb-3">Tiempo: {{ receta.tiempo }} min</p>
        <h4 class="text-sm font-semibold mb-1">Ingredientes:</h4>
        <ul class="text-sm text-gray-700 list-disc pl-5 mb-4">
          <li v-for="ing in receta.ingredientes" :key="ing">{{ ing }}</li>
        </ul>
        <button class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">Ver detalle</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import cocinaApi from '../../../api/cocina.js'

const query = ref('')
const recetas = ref([])

onMounted(async () => {
  recetas.value = await cocinaApi.fetchRecetas()
})

const filtered = computed(() =>
  recetas.value.filter(r => r.nombre.toLowerCase().includes(query.value.toLowerCase()))
)
</script>