<script setup>
import { ref, onMounted } from 'vue';
import { MesasApi } from '../api/client';

const mesas = ref([]);
const loading = ref(false);
const error = ref('');

const nombre = ref('');
const sucursal_id = ref(1);

async function load() {
  loading.value = true; error.value = '';
  try {
    const data = await MesasApi.list();
    mesas.value = Array.isArray(data?.data) ? data.data : (data?.mesas || data || []);
  } catch (e) { error.value = e.message; }
  finally { loading.value = false; }
}

async function createMesa() {
  try {
    await MesasApi.create({ nombre: nombre.value, sucursal_id: Number(sucursal_id.value) });
    nombre.value = ''; await load();
  } catch (e) { error.value = e.message; }
}

async function ocupar(id) { try { await MesasApi.ocupar(id); await load(); } catch (e) { error.value = e.message; } }
async function liberar(id) { try { await MesasApi.liberar(id); await load(); } catch (e) { error.value = e.message; } }
async function destroy(id) { try { await MesasApi.destroy(id); await load(); } catch (e) { error.value = e.message; } }

onMounted(load);
</script>

<template>
  <div class="container">
    <h2>Mesas</h2>
    <div v-if="error" class="error">{{ error }}</div>
    <div class="form">
      <input v-model="nombre" placeholder="Nombre mesa" />
      <input v-model="sucursal_id" type="number" min="1" placeholder="Sucursal ID" />
      <button @click="createMesa">Crear</button>
      <button @click="load">Refrescar</button>
    </div>
    <table>
      <thead><tr><th>ID</th><th>Nombre</th><th>Estado</th><th>Sucursal</th><th>Acciones</th></tr></thead>
      <tbody>
        <tr v-for="m in mesas" :key="m.id">
          <td>{{ m.id }}</td>
          <td>{{ m.nombre || m.name }}</td>
          <td>{{ m.estado || m.status }}</td>
          <td>{{ m.sucursal_id }}</td>
          <td>
            <button @click="ocupar(m.id)">Ocupar</button>
            <button @click="liberar(m.id)">Liberar</button>
            <button @click="destroy(m.id)" class="danger">Eliminar</button>
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