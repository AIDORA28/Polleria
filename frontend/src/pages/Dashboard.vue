<template>
  <div class="flex min-h-screen bg-gray-100 text-gray-800">
    <!-- Sidebar -->
    <aside :class="['bg-black text-white flex flex-col transition-all duration-300', sidebarOpen ? 'w-64' : 'w-16']">
      <!-- Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-700">
        <h1 v-if="sidebarOpen" class="text-2xl font-bold text-orange-500">🐔 Pollería</h1>
        <button @click="sidebarOpen = !sidebarOpen" class="text-orange-500 focus:outline-none">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 5h14M3 10h14M3 15h14" clip-rule="evenodd"/>
          </svg>
        </button>
      </div>

      <!-- Menú -->
      <nav class="flex-1 flex flex-col mt-4 px-2 space-y-2">
        <router-link
          v-for="item in menuItems"
          :key="item.name"
          :to="item.path"
          class="menu-link"
          :class="activeRoute === item.path ? 'active' : ''"
          @click="activeRoute = item.path"
        >
          <span class="text-lg">{{ item.icon }}</span>
          <span v-if="sidebarOpen" class="ml-3">{{ item.name }}</span>
        </router-link>
      </nav>

      <!-- Footer -->
      <div class="p-4 border-t border-gray-700 text-center text-sm text-gray-400">
        © 2025 Pollería App
      </div>
    </aside>

    <!-- Contenido principal -->
    <main class="flex-1 p-6 overflow-y-auto">
      <!-- Header -->
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-red-600">Dashboard</h2>
        <div class="flex items-center gap-3">
          <span class="text-sm text-gray-600">Bienvenido, Admin</span>
          <button class="btn btn-orange">Cerrar sesión</button>
        </div>
      </header>

      <!-- Cards uniformes -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card card-red">
          <h3 class="text-xl font-bold">Mesas ocupadas</h3>
          <p class="text-3xl mt-2">12</p>
        </div>
        <div class="card card-orange">
          <h3 class="text-xl font-bold">Pedidos pendientes</h3>
          <p class="text-3xl mt-2">5</p>
        </div>
        <div class="card card-black">
          <h3 class="text-xl font-bold">Insumos críticos</h3>
          <p class="text-3xl mt-2">3</p>
        </div>
      </div>

      <!-- Contenido dinámico -->
      <div class="card bg-white h-96">
        <router-view />
      </div>
    </main>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sidebarOpen: true,
      activeRoute: '/dashboard',
      menuItems: [
        { name: 'Dashboard', path: '/dashboard', icon: '🏠' },
        { name: 'Mesas', path: '/mesas', icon: '🍽️' },
        { name: 'Insumos', path: '/insumos', icon: '📦' },
        { name: 'Pedidos', path: '/pedidos', icon: '🧾' },
        { name: 'Empleados', path: '/empleados', icon: '👨‍🍳' },
        { name: 'Reportes', path: '/reportes', icon: '📊' },
      ],
    };
  },
};
</script>

<style scoped>
/* Sidebar */
aside {
  min-height: 100vh;
}
.menu-link {
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  font-weight: 500;
  color: white;
  transition: all 0.2s;
}
.menu-link:hover {
  background-color: #272727;
}
.menu-link.active {
  background-color: #f97316; /* naranja */
  color: black;
  font-weight: bold;
}

/* Botones header */
.btn {
  border-radius: 0.5rem;
  border: 2px solid transparent;
  padding: 0.5rem 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s;
}
.btn-orange {
  background-color: #f97316;
  color: white;
}
.btn-orange:hover {
  background-color: #dc2626; /* rojo */
}

/* Cards */
.card {
  border-radius: 1rem;
  border: 2px solid #e5e7eb;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transition: all 0.3s;
  height: 10rem;
}
.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Colores de cards */
.card-red { background-color: #dc2626; color: white; }
.card-orange { background-color: #f97316; color: white; }
.card-black { background-color: black; color: white; }
</style>
