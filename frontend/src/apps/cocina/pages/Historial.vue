<template>
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Historial de Pedidos</h2>
      <div class="flex gap-2">
        <input v-model="query" placeholder="Buscar ticket o mesa..." class="border rounded-lg px-3 py-2 w-64" />
        <select v-model="rango" class="border rounded-lg px-3 py-2">
          <option value="hoy">Hoy</option>
          <option value="ayer">Ayer</option>
          <option value="semana">Últimos 7 días</option>
        </select>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Ticket</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Mesa</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Items</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Estado</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Hora</th>
            <th class="px-4 py-2"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <tr v-for="p in filtrados" :key="p.id">
            <td class="px-4 py-2 text-sm">#{{ p.id }}</td>
            <td class="px-4 py-2 text-sm">{{ p.mesa }}</td>
            <td class="px-4 py-2 text-sm">{{ p.items.join(', ') }}</td>
            <td class="px-4 py-2 text-sm">
              <span class="text-xs px-2 py-1 rounded bg-green-100 text-green-800 border border-green-200">{{ p.estado }}</span>
            </td>
            <td class="px-4 py-2 text-sm">{{ p.hora }}</td>
            <td class="px-4 py-2 text-right">
              <button class="text-sm bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded">Detalle</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import cocinaApi from '../../../api/cocina.js'

const query = ref('')
const rango = ref('hoy')
const historial = ref([])

onMounted(async () => {
  historial.value = await cocinaApi.fetchHistorial()
})

const filtrados = computed(() =>
  historial.value.filter(p => {
    const texto = `${p.id} ${p.mesa}`.toLowerCase()
    return texto.includes(query.value.toLowerCase())
  })
)
</script>