<template>
  <div class="brand-panel">
    <div class="brand-overlay" aria-hidden="true">
      <svg class="overlay-svg" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <defs>
          <linearGradient id="g1" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#ffffff" stop-opacity="0.25"/>
            <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
          </linearGradient>
        </defs>
        <circle cx="15%" cy="20%" r="120" fill="url(#g1)"/>
        <circle cx="85%" cy="70%" r="160" fill="url(#g1)"/>
      </svg>
    </div>

    <div class="brand-content">
      <div class="brand-header">
        <div class="brand-logo" aria-label="Logo Pollería">
          <svg class="brand-icon" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M44 20c-6 0-12 4-14 9l-8 8c-3 3-3 8 0 11s8 3 11 0l8-8c5-2 9-8 9-14 0-3-2-6-6-6z" fill="currentColor"/>
            <path d="M18 42c-2 0-4 2-4 4s2 4 4 4 4-2 4-4-2-4-4-4z" fill="currentColor"/>
            <path d="M52 14c0 4-3 7-7 7s-7-3-7-7 3-7 7-7 7 3 7 7z" fill="currentColor" opacity="0.85"/>
          </svg>
        </div>
        <div>
          <h1 class="brand-title">{{ title }}</h1>
          <p class="brand-subtitle">{{ subtitle }}</p>
        </div>
      </div>

      <h2 class="brand-headline">{{ headline }}</h2>
      <p class="brand-description">{{ description }}</p>

      <div class="brand-points">
        <div v-for="(p, i) in points" :key="i" class="point">
          <div class="point-icon">{{ p.icon }}</div>
          <div>
            <p class="point-title">{{ p.title }}</p>
            <p class="point-sub">{{ p.sub }}</p>
          </div>
        </div>
      </div>

      <slot name="extra"></slot>
      <div class="brand-footer">
        <slot name="footer">{{ footer }}</slot>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  logoText: { type: String, default: '🍗' },
  title: { type: String, default: 'Pollería Koreanka' },
  subtitle: { type: String, default: 'Gestión integral para tu restaurante' },
  headline: { type: String, default: 'Sabor que enamora, gestión que responde' },
  description: { type: String, default: 'Organiza pedidos, cocina, inventario y tiempos en un sistema hecho a la medida de una pollería que jala gente.' },
  points: {
    type: Array,
    default: () => [
      { icon: '🍽️', title: 'Pedidos ágiles', sub: 'Flujos rápidos desde toma hasta cocina' },
      { icon: '🔥', title: 'Tiempos controlados', sub: 'Métricas y alertas para no perder ritmo' },
      { icon: '📦', title: 'Inventario preciso', sub: 'Reposición sin sorpresas en hora pico' },
      { icon: '🔒', title: 'Accesos por rol', sub: 'Cada equipo con lo que necesita' }
    ]
  },
  footer: { type: String, default: '© 2025 Koreanka — Gestión de Pollería' }
})
</script>

<style scoped>
:root {
  --brand-primary: #d32f2f;
  --brand-primary-dark: #b71c1c;
  --brand-accent: #f44336;
  --brand-orange: #ff9800;
  --brand-yellow: #ffc107;
  --brand-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.brand-panel {
  background: linear-gradient(135deg, var(--brand-primary), var(--brand-accent) 50%, var(--brand-orange) 100%);
  color: #fff;
  padding: 3rem 2rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  position: relative;
  overflow: hidden;
  animation: slideInLeft 0.8s ease-out;
}

.brand-overlay { position: absolute; inset: 0; z-index: 1; pointer-events: none; }
.overlay-svg { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0.6; }
.brand-overlay::after { content: ""; position: absolute; inset: 0; background: repeating-linear-gradient(45deg, rgba(255,255,255,0.08) 0px, rgba(255,255,255,0.08) 6px, rgba(0,0,0,0.08) 6px, rgba(0,0,0,0.08) 12px); opacity: 0.25; }

.brand-panel::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
  animation: float 6s ease-in-out infinite;
}

.brand-content { position: relative; z-index: 2; max-width: 400px; }

.brand-logo {
  width: 80px;
  height: 80px;
  margin: 0 auto 1.5rem;
  background: rgba(255, 255, 255, 0.18);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(8px);
  border: 1px solid rgba(255, 255, 255, 0.25);
  animation: pulse 2s ease-in-out infinite;
}
.brand-icon { width: 42px; height: 42px; color: #fff; }

.brand-title { font-size: 2.4rem; font-weight: 800; margin: 0 0 0.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3); animation: fadeInUp 0.8s ease-out 0.2s both; }
.brand-subtitle { font-size: 1.1rem; font-weight: 500; margin: 0 0 1rem; opacity: 0.92; animation: fadeInUp 0.8s ease-out 0.4s both; }
.brand-headline { font-size: 1.25rem; font-weight: 700; margin: 0 0 1rem; animation: fadeInUp 0.8s ease-out 0.6s both; }
.brand-description { font-size: 1rem; line-height: 1.6; margin: 0 0 2rem; opacity: 0.88; animation: fadeInUp 0.8s ease-out 0.8s both; }

.brand-points {
  list-style: none;
  padding: 0;
  margin: 0 0 2rem;
  animation: fadeInUp 0.8s ease-out 1s both;
}

.brand-points li {
  display: flex;
  align-items: center;
  margin-bottom: 0.75rem;
  font-size: 0.95rem;
  opacity: 0.9;
}

.brand-points li::before {
  content: '✓';
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 20px;
  height: 20px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  margin-right: 0.75rem;
  font-weight: bold;
  font-size: 12px;
}

.brand-footer {
  font-size: 0.9rem;
  opacity: 0.8;
  margin-top: auto;
  animation: fadeInUp 0.8s ease-out 1.2s both;
}

@media (max-width: 1023px) {
  .brand-panel {
    padding: 2rem 1.5rem;
    text-align: center;
  }
  
  .brand-title {
    font-size: 2rem;
  }
  
  .brand-subtitle {
    font-size: 1rem;
  }
  
  .brand-headline {
    font-size: 1.1rem;
  }
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
  }
  50% {
    transform: scale(1.05);
    box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
  }
}

@keyframes float {
  0%, 100% {
    transform: translate(-50%, -50%) rotate(0deg);
  }
  33% {
    transform: translate(-48%, -52%) rotate(120deg);
  }
  66% {
    transform: translate(-52%, -48%) rotate(240deg);
  }
}
</style>