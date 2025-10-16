<script setup>
import { ref, onMounted } from 'vue';
import { InsumosApi } from '../api/client';

const items = ref([]);
const error = ref('');
const nombre = ref('');
const sucursal_id = ref(1);

const with_trashed = ref(false);
const only_trashed = ref(false);

async function load() {
  error.value = '';
  try {
    const params = new URLSearchParams();
    if (with_trashed.value) params.set('with_trashed', '1');
    if (only_trashed.value) params.set('only_trashed', '1');
    const query = params.toString() ? `?${params.toString()}` : '';
    const data = await InsumosApi.list(query);
    items.value = Array.isArray(data?.data) ? data.data : (data?.insumos || data || []);
  } catch (e) { error.value = e.message; }
}

async function createItem() {
  try {
    await InsumosApi.create({ nombre: nombre.value, sucursal_id: Number(sucursal_id.value) });
    nombre.value = ''; await load();
  } catch (e) { error.value = e.message; }
}

async function destroy(id) { try { await InsumosApi.destroy(id); await load(); } catch (e) { error.value = e.message; } }
async function restore(id) { try { await InsumosApi.restore(id); await load(); } catch (e) { error.value = e.message; } }

onMounted(load);
</script>

<template>
  <div class="container">
    <h2>Insumos</h2>
    <div v-if="error" class="error">{{ error }}</div>
    <div class="form">
      <input v-model="nombre" placeholder="Nombre insumo" />
      <input v-model="sucursal_id" type="number" min="1" placeholder="Sucursal ID" />
      <button @click="createItem">Crear</button>
      <button @click="load">Refrescar</button>
    </div>
    <div class="filters">
      <label><input type="checkbox" v-model="with_trashed" @change="load" /> with_trashed</label>
      <label><input type="checkbox" v-model="only_trashed" @change="load" /> only_trashed</label>
    </div>
    <table>
      <thead><tr><th>ID</th><th>Nombre</th><th>Sucursal</th><th>Acciones</th></tr></thead>
      <tbody>
        <tr v-for="it in items" :key="it.id">
          <td>{{ it.id }}</td>
          <td>{{ it.nombre || it.name }}</td>
          <td>{{ it.sucursal_id }}</td>
          <td>
            <button @click="destroy(it.id)" class="danger">Eliminar</button>
            <button @click="restore(it.id)" class="secondary">Restaurar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
.container { padding: 16px; }
.form { display: flex; gap: 8px; margin-bottom: 12px; }
.filters { display: flex; gap: 12px; margin-bottom: 12px; }
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ddd; padding: 6px; }
.danger { color: #b00000; }
.secondary { color: #0050b0; }
.error { color: #b00000; margin-bottom: 8px; }
</style>