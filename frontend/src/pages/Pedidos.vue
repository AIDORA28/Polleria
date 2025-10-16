<script setup>
import { ref, onMounted } from 'vue';
import { PedidosApi } from '../api/client';

const pedidos = ref([]);
const error = ref('');

const mesa_id = ref('');
const sucursal_id = ref(1);

async function load() {
  error.value = '';
  try {
    const params = new URLSearchParams();
    if (mesa_id.value) params.set('mesa_id', String(mesa_id.value));
    const query = params.toString() ? `?${params.toString()}` : '';
    const data = await PedidosApi.list(query);
    pedidos.value = Array.isArray(data?.data) ? data.data : (data?.pedidos || data || []);
  } catch (e) { error.value = e.message; }
}

async function createPedido() {
  try {
    await PedidosApi.create({ mesa_id: Number(mesa_id.value), sucursal_id: Number(sucursal_id.value) });
    mesa_id.value = ''; await load();
  } catch (e) { error.value = e.message; }
}

async function cerrar(id) { try { await PedidosApi.cerrar(id); await load(); } catch (e) { error.value = e.message; } }
async function abrir(id) { try { await PedidosApi.abrir(id); await load(); } catch (e) { error.value = e.message; } }
async function cancelar(id) { try { await PedidosApi.cancelar(id); await load(); } catch (e) { error.value = e.message; } }
async function destroy(id) { try { await PedidosApi.destroy(id); await load(); } catch (e) { error.value = e.message; } }

onMounted(load);
</script>

<template>
  <div class="container">
    <h2>Pedidos</h2>
    <div v-if="error" class="error">{{ error }}</div>
    <div class="form">
      <input v-model="mesa_id" type="number" min="1" placeholder="Mesa ID" />
      <input v-model="sucursal_id" type="number" min="1" placeholder="Sucursal ID" />
      <button @click="createPedido">Crear</button>
      <button @click="load">Refrescar</button>
    </div>
    <table>
      <thead><tr><th>ID</th><th>Mesa</th><th>Estado</th><th>Sucursal</th><th>Acciones</th></tr></thead>
      <tbody>
        <tr v-for="p in pedidos" :key="p.id">
          <td>{{ p.id }}</td>
          <td>{{ p.mesa_id }}</td>
          <td>{{ p.estado || p.status }}</td>
          <td>{{ p.sucursal_id }}</td>
          <td>
            <button @click="cerrar(p.id)">Cerrar</button>
            <button @click="abrir(p.id)">Abrir</button>
            <button @click="cancelar(p.id)">Cancelar</button>
            <button @click="destroy(p.id)" class="danger">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
.container { padding: 16px; }
.form { display: flex; gap: 8px; margin-bottom: 12px; }
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
.danger { color: #b00000; }
.error { color: #b00000; margin-bottom: 8px; }
</style>