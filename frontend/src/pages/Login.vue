<template>
  <div class="min-h-screen bg-gradient-to-br from-brand-primary via-brand-secondary to-brand-accent flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
      <!-- Logo y Título -->
      <div class="text-center mb-8">
        <div class="bg-gradient-to-r from-brand-primary to-brand-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
          <span class="text-2xl">🍗</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Sistema Pollería</h1>
        <p class="text-gray-600">Ingresa tus credenciales para acceder</p>
      </div>

      <!-- Formulario de Login -->
      <form @submit.prevent="handleLogin" class="space-y-6">
        <!-- Campo Usuario -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
            Usuario
          </label>
          <input
            id="username"
            v-model="credentials.username"
            type="text"
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-colors"
            placeholder="Ingresa tu usuario"
          />
        </div>

        <!-- Campo Contraseña -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
            Contraseña
          </label>
          <input
            id="password"
            v-model="credentials.password"
            type="password"
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-colors"
            placeholder="Ingresa tu contraseña"
          />
        </div>

        <!-- Mensaje de Error -->
        <div v-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
          {{ error }}
        </div>

        <!-- Botón de Login -->
        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-gradient-to-r from-brand-primary to-brand-secondary text-white py-3 px-4 rounded-lg font-medium hover:from-brand-primary/90 hover:to-brand-secondary/90 focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-offset-2 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <span v-if="loading" class="flex items-center justify-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Iniciando sesión...
          </span>
          <span v-else>Iniciar Sesión</span>
        </button>
      </form>

      <!-- Credenciales de Prueba (Solo en modo mock) -->
      <div v-if="showMockCredentials" class="mt-8 p-4 bg-gray-50 rounded-lg">
        <h3 class="text-sm font-medium text-gray-700 mb-3">Credenciales de Prueba:</h3>
        <div class="grid grid-cols-2 gap-2 text-xs">
          <div class="bg-white p-2 rounded border">
            <strong>Owner:</strong> owner/owner123
          </div>
          <div class="bg-white p-2 rounded border">
            <strong>Caja:</strong> caja/caja123
          </div>
          <div class="bg-white p-2 rounded border">
            <strong>Cocinero:</strong> cocinero/cocina123
          </div>
          <div class="bg-white p-2 rounded border">
            <strong>Mesero:</strong> mesero/mesero123
          </div>
          <div class="bg-white p-2 rounded border">
            <strong>Delivery:</strong> delivery/delivery123
          </div>
          <div class="bg-white p-2 rounded border">
            <strong>Almacenero:</strong> almacenero/almacen123
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import auth from '../auth/index.js'

const router = useRouter()

const credentials = ref({
  username: '',
  password: ''
})

const error = ref('')
const loading = ref(false)

// Mostrar credenciales de prueba solo en modo mock
const showMockCredentials = computed(() => auth.isMockAuth)

async function handleLogin() {
  error.value = ''
  loading.value = true

  try {
    const success = await auth.login(credentials.value.username, credentials.value.password)
    
    if (success) {
      const user = auth.getCurrentUser()
      
      // Abrir nueva ventana con el sistema correspondiente según el rol
      const roleRoutes = {
        owner: '/owner',
        caja: '/caja',
        cocinero: '/cocina',
        mesero: '/meseros',
        delivery: '/delivery',
        almacenero: '/almacenero'
      }
      
      const route = roleRoutes[user.role]
      if (route) {
        // Abrir en nueva ventana
        const newWindow = window.open(
          `${window.location.origin}${route}`,
          '_blank',
          'width=1200,height=800,scrollbars=yes,resizable=yes'
        )
        
        if (newWindow) {
          // Cerrar la ventana de login después de un breve delay
          setTimeout(() => {
            window.close()
          }, 1000)
        } else {
          // Si no se puede abrir nueva ventana, navegar en la misma
          router.push(route)
        }
      } else {
        error.value = 'Rol de usuario no reconocido'
      }
    } else {
      error.value = 'Credenciales incorrectas'
    }
  } catch (err) {
    error.value = 'Error al iniciar sesión'
    console.error('Login error:', err)
  } finally {
    loading.value = false
  }
}
</script>