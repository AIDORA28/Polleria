<template>
  <div class="form-panel">
    <div class="form-wrap">
      <div class="form-header">
        <h3>{{ title }}</h3>
        <p>{{ subtitle }}</p>
      </div>

      <form @submit.prevent="onSubmit" class="form">
        <div>
          <label for="username" class="form-label">{{ usernameLabel }}</label>
          <input id="username" v-model="username" type="text" required class="form-input" :placeholder="usernamePlaceholder" />
        </div>

        <div>
          <label for="password" class="form-label">{{ passwordLabel }}</label>
          <div class="password-wrap">
            <input :type="showPassword ? 'text' : 'password'" id="password" v-model="password" required class="form-input password-input" :placeholder="passwordPlaceholder" />
            <button type="button" @click="showPassword = !showPassword" class="password-toggle">
              <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              <svg v-else xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.978 9.978 0 012.228-3.5M6.223 6.223A9.978 9.978 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.978 9.978 0 01-3.03 4.225M15 12a3 3 0 00-3-3"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
              </svg>
            </button>
          </div>
        </div>

        <div v-if="error" class="error-box">{{ error }}</div>

        <div class="form-actions">
          <label v-if="showRemember" class="remember">
            <input type="checkbox" v-model="remember" />
            Recordarme
          </label>
          <a v-if="forgotText" :href="forgotHref || '#'" @click.prevent="emit('forgot')" class="forgot">{{ forgotText }}</a>
        </div>

        <button type="submit" :disabled="loading" class="login-button">
          <span v-if="loading" class="loading">
            <svg class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="spinner-track" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="spinner-path" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ loadingText }}
          </span>
          <span v-else>{{ submitText }}</span>
        </button>
      </form>

      <div v-if="showMockCredentials" class="mock">
        <h3>Credenciales de Prueba:</h3>
        <div class="mock-grid">
          <div class="mock-item"><strong>Owner:</strong> owner/owner123</div>
          <div class="mock-item"><strong>Caja:</strong> caja/caja123</div>
          <div class="mock-item"><strong>Cocinero:</strong> cocinero/cocina123</div>
          <div class="mock-item"><strong>Mesero:</strong> mesero/mesero123</div>
          <div class="mock-item"><strong>Delivery:</strong> delivery/delivery123</div>
          <div class="mock-item"><strong>Almacenero:</strong> almacenero/almacen123</div>
        </div>
      </div>

      <slot name="below"></slot>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  error: { type: String, default: '' },
  loading: { type: Boolean, default: false },
  showMockCredentials: { type: Boolean, default: false },
  title: { type: String, default: 'Inicia sesión' },
  subtitle: { type: String, default: 'Bienvenido al sistema — ingresa tus credenciales' },
  usernameLabel: { type: String, default: 'Usuario' },
  usernamePlaceholder: { type: String, default: 'Ingresa tu usuario' },
  passwordLabel: { type: String, default: 'Contraseña' },
  passwordPlaceholder: { type: String, default: 'Ingresa tu contraseña' },
  submitText: { type: String, default: 'Iniciar Sesión' },
  loadingText: { type: String, default: 'Iniciando sesión...' },
  showRemember: { type: Boolean, default: false },
  forgotText: { type: String, default: '' },
  forgotHref: { type: String, default: '#' }
})

const emit = defineEmits(['submit', 'forgot'])

const username = ref('')
const password = ref('')
const remember = ref(false)
const showPassword = ref(false)

function onSubmit() {
  emit('submit', { username: username.value, password: password.value, remember: remember.value })
}
</script>

<style scoped>
:root {
  --brand-primary: #d32f2f;
  --brand-primary-dark: #b71c1c;
  --brand-accent: #f44336;
  --brand-shadow: 0 8px 25px rgba(0,0,0,0.15);
  --brand-shadow-hover: 0 12px 28px rgba(211,47,47,0.35);
}

.form-panel { 
  background: #fff; 
  padding: 2rem; 
}

@media (min-width: 1024px) { 
  .form-panel { 
    padding: 3rem; 
  } 
}

.form-wrap { 
  max-width: 520px; 
  margin: 0 auto; 
}

.form-header h3 { 
  font-size: 22px; 
  font-weight: 700; 
  color: #1f2937; 
  margin: 0; 
}

.form-header p { 
  color: #4b5563; 
  margin: 6px 0 0; 
}

.form { 
  display: grid; 
  gap: 18px; 
}

.form-label { 
  display: block; 
  font-size: 13px; 
  font-weight: 600; 
  color: #374151; 
  margin-bottom: 8px; 
}

.form-input { 
  width: 100%; 
  padding: 12px 14px; 
  border: 2px solid #e0e0e0; 
  border-radius: 10px; 
  transition: all 0.2s; 
  color: #111827; 
  background: #fff;
}

.form-input::placeholder { 
  color: #9ca3af; 
}

.form-input:focus { 
  outline: none; 
  border-color: var(--brand-primary); 
  box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.12);
}

.password-wrap { position: relative; }
.password-input { padding-right: 48px; }
.password-toggle { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #6b7280; background: transparent; border: none; padding: 0; cursor: pointer; }
.password-toggle:hover { color: #374151; }
.icon { width: 20px; height: 20px; }

.error-box { 
  background: rgba(211, 47, 47, 0.05); 
  border: 1px solid rgba(211, 47, 47, 0.20); 
  color: #b71c1c; 
  padding: 10px 14px; 
  border-radius: 10px; 
  font-size: 13px; 
}

.form-actions { display: flex; align-items: center; justify-content: space-between; font-size: 13px; }
.remember { display: inline-flex; align-items: center; gap: 8px; color: #111827; }
.forgot { color: var(--brand-primary); text-decoration: none; }
.forgot:hover { text-decoration: underline; }

.login-button { 
  width: 100%; 
  background: linear-gradient(to right, var(--brand-primary), var(--brand-accent)); 
  color: #fff; 
  padding: 14px 16px; 
  border: none; 
  border-radius: 10px; 
  font-weight: 600; 
  box-shadow: var(--brand-shadow); 
  transition: transform .15s ease, box-shadow .15s ease, background .15s ease; 
  cursor: pointer; 
}
.login-button:hover { background: linear-gradient(to right, var(--brand-primary-dark), var(--brand-accent)); box-shadow: var(--brand-shadow-hover); transform: translateY(-2px); }
.login-button:disabled { opacity: .6; cursor: not-allowed; }

.loading { display: inline-flex; align-items: center; justify-content: center; gap: 10px; }
.spinner { animation: spin 1s linear infinite; width: 20px; height: 20px; }
.spinner-track { opacity: .25; }
.spinner-path { opacity: .75; }

.mock { margin-top: 24px; padding: 16px; background: #f9fafb; border-radius: 10px; }
.mock h3 { font-size: 13px; font-weight: 600; color: #374151; margin: 0 0 10px; }
.mock-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 12px; }
.mock-item { background: #fff; padding: 8px; border-radius: 6px; border: 1px solid #e5e7eb; }

@keyframes spin { to { transform: rotate(360deg); } }
</style>