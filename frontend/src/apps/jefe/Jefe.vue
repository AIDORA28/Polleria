<script setup>
import { ref } from 'vue';

// Datos de ejemplo para pruebas frontend
const sucursales = ref([
  { id: 1, nombre: 'Sucursal Centro', estado: 'Operativa', pedidos_activos: 12, tiempo_promedio: 18, ingresos_hoy: 3450 },
  { id: 2, nombre: 'Sucursal Norte', estado: 'Operativa', pedidos_activos: 9, tiempo_promedio: 22, ingresos_hoy: 2870 },
  { id: 3, nombre: 'Sucursal Sur', estado: 'Mantenimiento', pedidos_activos: 0, tiempo_promedio: 0, ingresos_hoy: 0 },
]);

const kpis = ref([
  { label: 'Ventas Hoy', value: '$8,320', icon: 'fa-shopping-cart', color: '#d32f2f' },
  { label: 'Pedidos Activos', value: '21', icon: 'fa-clipboard-check', color: '#0277bd' },
  { label: 'Tiempo Promedio', value: '19 min', icon: 'fa-clock', color: '#f57c00' },
  { label: 'Personal Activo', value: '23', icon: 'fa-users', color: '#2e7d32' },
]);
</script>

<template>
  <div class="jefe-layout">
    <header class="header">
      <h1>Panel Jefe</h1>
      <p>Estado de sucursales, ingresos y métricas clave</p>
    </header>

    <section class="kpi-grid">
      <div v-for="(k, idx) in kpis" :key="idx" class="kpi-card">
        <div class="kpi-icon" :style="{ color: k.color }">
          <i :class="['fas', k.icon]"></i>
        </div>
        <div class="kpi-value">{{ k.value }}</div>
        <div class="kpi-label">{{ k.label }}</div>
      </div>
    </section>

    <section class="sucursales">
      <h2>Estado de Sucursales</h2>
      <div class="branches">
        <div v-for="s in sucursales" :key="s.id" class="branch-card" :class="{ inactive: s.estado !== 'Operativa' }">
          <div class="branch-header">
            <h3>{{ s.nombre }}</h3>
            <span class="status" :class="s.estado.toLowerCase()">{{ s.estado }}</span>
          </div>
          <div class="branch-body">
            <div class="metric"><strong>Pedidos activos:</strong> {{ s.pedidos_activos }}</div>
            <div class="metric"><strong>Tiempo prom.:</strong> {{ s.tiempo_promedio }} min</div>
            <div class="metric"><strong>Ingresos hoy:</strong> S/ {{ s.ingresos_hoy }}</div>
          </div>
        </div>
      </div>
    </section>

    <section class="ingresos">
      <h2>Reporte de Ingresos por Sucursal</h2>
      <table class="table">
        <thead>
          <tr><th>Sucursal</th><th>Ingresos Hoy</th><th>Estado</th></tr>
        </thead>
        <tbody>
          <tr v-for="s in sucursales" :key="s.id">
            <td>{{ s.nombre }}</td>
            <td>S/ {{ s.ingresos_hoy }}</td>
            <td>{{ s.estado }}</td>
          </tr>
        </tbody>
      </table>
    </section>
  </div>
</template>

<style scoped>
.jefe-layout { padding: 16px; }
.header { background: linear-gradient(to right, #d32f2f, #b71c1c); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.header h1 { margin-bottom: 6px; }
.kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin: 18px 0; }
.kpi-card { background: white; border-radius: 10px; padding: 18px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); text-align: center; }
.kpi-icon { font-size: 24px; margin-bottom: 8px; }
.kpi-value { font-size: 22px; font-weight: 700; }
.kpi-label { font-size: 13px; color: #666; }
.sucursales h2, .ingresos h2 { margin: 12px 0; }
.branches { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; }
.branch-card { background: white; border-radius: 12px; padding: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-top: 4px solid #d32f2f; }
.branch-card.inactive { opacity: 0.8; }
.branch-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
.status { padding: 4px 8px; border-radius: 14px; font-size: 12px; }
.status.operativa { background: rgba(46,125,50,0.12); color: #2e7d32; }
.status.mantenimiento { background: rgba(2,119,189,0.12); color: #0277bd; }
.branch-body .metric { margin: 4px 0; }
.table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
.table th, .table td { padding: 10px 12px; border-bottom: 1px solid #eee; text-align: left; }
.table thead th { background: #f5f5f5; font-weight: 600; }
</style>