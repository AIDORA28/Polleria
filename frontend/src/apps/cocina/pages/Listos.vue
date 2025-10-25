<template>
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Pedidos Listos</h2>
      <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Actualizar</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="pedido in listos" :key="pedido.id" class="bg-white rounded-xl shadow p-4 border border-gray-100">
        <div class="flex justify-between items-center mb-2">
          <div>
            <h3 class="text-lg font-semibold">Mesa {{ pedido.mesa }}</h3>
            <p class="text-sm text-gray-600">Ticket #{{ pedido.id }}</p>
          </div>
          <span class="text-xs px-2 py-1 rounded bg-green-100 text-green-800 border border-green-200">Listo</span>
        </div>
        <ul class="text-sm text-gray-700 list-disc pl-5 mb-4">
          <li v-for="item in pedido.items" :key="item" class="mb-1">{{ item }}</li>
        </ul>
        <div class="flex gap-2">
          <button @click="notifyServe(pedido)" class="flex-1 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg">Notificar a Mesero</button>
          <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">Detalles</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import cocinaApi from '../../../api/cocina.js'

const listos = ref([])

onMounted(async () => {
  listos.value = await cocinaApi.fetchListos()
})

function notifyServe(p) {
  alert(`Notificando a mesero para pedido #${p.id}`)
}
</script>