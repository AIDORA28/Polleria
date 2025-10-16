<script setup>
</script>

<template>
  <div class="layout">
    <header class="header">
      <h1>Pollería</h1>
      <nav class="nav">
        <router-link to="/">Inicio</router-link>
        <router-link to="/mesas">Mesas</router-link>
        <router-link to="/insumos">Insumos</router-link>
        <router-link to="/pedidos">Pedidos</router-link>
      </nav>
    </header>
    <main class="main">
      <router-view />
    </main>
  </div>
  
</template>

<style scoped>
.layout { display: flex; flex-direction: column; min-height: 100vh; }
.header { display: flex; align-items: center; justify-content: space-between; padding: 10px 16px; border-bottom: 1px solid #e5e5e5; }
.nav { display: flex; gap: 10px; }
.nav a { padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px; }
.main { padding: 16px; flex: 1; }
</style>
