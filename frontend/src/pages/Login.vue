<template>
  <div class="login-page">
    <div class="login-card">
      <div class="photo-panel" role="img" aria-label="Foto de la pollería"></div>
      <div class="right-content">
        <h1 class="site-title">Polleria koreanka</h1>
        <LoginForm
          :error="error"
          :loading="loading"
          :showMockCredentials="false"
          :showRemember="false"
          :forgotText="''"
          :title="'Inicia Sesión'"
          :subtitle="'Bienvenido al sistema — ingresa tus credenciales'"
          @submit="onSubmit"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import auth from '../auth/index.js'
import BrandPanel from '../components/BrandPanel.vue'
import LoginForm from '../components/LoginForm.vue'

const router = useRouter()
const error = ref('')
const loading = ref(false)

const showMockCredentials = computed(() => auth.isMockAuth)

async function onSubmit(payload) {
  const { username, password } = payload
  error.value = ''
  loading.value = true
  try {
    const success = await auth.login(username, password)
    if (success) {
      const user = auth.getCurrentUser()
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
        const newWindow = window.open(`${window.location.origin}${route}`, '_blank', 'width=1200,height=800,scrollbars=yes,resizable=yes')
        if (newWindow) {
          setTimeout(() => { window.close() }, 1000)
        } else {
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
function onForgot() {
  try {
    router.push('/forgot')
  } catch (e) {
    // Fallback si no existe la ruta
    if (typeof error !== 'undefined' && error && typeof error.value !== 'undefined') {
      error.value = 'Recuperación de contraseña no disponible.'
    }
  }
}
</script>

<style scoped>
.login-page { 
  min-height: 100vh; 
  background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 50%, #fff8e1 100%); 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  animation: fadeIn 0.8s ease-out;
}

.login-card { 
  width: 100%; 
  max-width: 1200px; 
  display: grid; 
  grid-template-columns: 1fr; 
  border-radius: 24px; 
  overflow: hidden; 
  box-shadow: 0 20px 60px rgba(0,0,0,0.15);
  background: #fff;
  animation: slideUp 0.6s ease-out;
}

@media (min-width: 1024px) { 
  .login-card { 
    grid-template-columns: 1fr 1fr; 
  } 
}

.photo-panel {
  position: relative;
  background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200&auto=format&fit=crop');
  background-size: cover;
  background-position: center;
  min-height: 280px;
}
.photo-panel::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,0.25), rgba(0,0,0,0.15));
}

.right-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.site-title { 
  font-size: 2rem; 
  font-weight: 800; 
  color: #d32f2f; 
  margin: 0 0 1rem; 
  text-align: center; 
}

@media (min-width: 1024px) {
  .photo-panel { min-height: auto; }
  .right-content { padding: 3rem; }
  .site-title { font-size: 2.4rem; }
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { 
    opacity: 0;
    transform: translateY(30px);
  }
  to { 
    opacity: 1;
    transform: translateY(0);
  }
}
</style>