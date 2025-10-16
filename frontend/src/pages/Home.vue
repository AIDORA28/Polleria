<template>
  <div class="container">
    <h1>Pollería - SPA</h1>
    <p>Selecciona una sección:</p>
    <nav class="nav">
      <router-link to="/mesas">Mesas</router-link>
      <router-link to="/insumos">Insumos</router-link>
      <router-link to="/pedidos">Pedidos</router-link>
    </nav>
  </div>
</template>

<style scoped>
.container { padding: 16px; }
.nav { display: flex; gap: 12px; margin-top: 8px; }
.nav a { padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px; }
</style>