import { ref } from 'vue';

// Placeholder para integrar autenticación real cuando el backend esté listo
const user = ref(null);

function login() {
  throw new Error('Autenticación real no implementada');
}

function logout() { user.value = null; }
function getCurrentUser() { return user.value; }
function hasRole() { return false; }
function isLoggedIn() { return !!user.value; }

export const isMockAuth = false;

export function useAuth() {
  return { user, login, logout, hasRole, isLoggedIn };
}

export default { login, logout, getCurrentUser, hasRole, isLoggedIn };