import { ref } from 'vue';

const STORAGE_KEY = 'auth_user';

// Cuentas únicas por sistema (solo frontend, mock)
const env = import.meta.env;
export const mockUsers = {
  owner: { username: env.VITE_AUTH_MOCK_OWNER_USER ?? 'owner', password: env.VITE_AUTH_MOCK_OWNER_PASS ?? 'owner123', role: 'owner' },
  caja: { username: env.VITE_AUTH_MOCK_CAJA_USER ?? 'caja', password: env.VITE_AUTH_MOCK_CAJA_PASS ?? 'caja123', role: 'caja' },
  cocina: { username: env.VITE_AUTH_MOCK_COCINA_USER ?? 'cocina', password: env.VITE_AUTH_MOCK_COCINA_PASS ?? 'cocina123', role: 'cocinero' },
  mesero: { username: env.VITE_AUTH_MOCK_MESERO_USER ?? 'mesero', password: env.VITE_AUTH_MOCK_MESERO_PASS ?? 'mesero123', role: 'mesero' },
  delivery: { username: env.VITE_AUTH_MOCK_DELIVERY_USER ?? 'delivery', password: env.VITE_AUTH_MOCK_DELIVERY_PASS ?? 'delivery123', role: 'delivery' },
  almacenero: { username: env.VITE_AUTH_MOCK_ALMACENERO_USER ?? 'almacenero', password: env.VITE_AUTH_MOCK_ALMACENERO_PASS ?? 'almacen123', role: 'almacenero' },
};

const user = ref(null);

function init() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (raw) user.value = JSON.parse(raw);
  } catch {}
}
init();

function login(arg1, arg2) {
  // Soporta login({ role, username, password }) y login(username, password)
  if (typeof arg1 === 'object' && arg1 !== null) {
    const { role, username, password } = arg1;
    const expected = mockUsers[role];
    if (!expected) throw new Error('Rol no válido');
    if (username !== expected.username || password !== expected.password) {
      throw new Error('Credenciales inválidas');
    }
    user.value = { username, role: expected.role };
  } else {
    const username = arg1;
    const password = arg2;
    const match = Object.values(mockUsers).find(u => u.username === username && u.password === password);
    if (!match) throw new Error('Credenciales inválidas');
    user.value = { username, role: match.role };
  }
  localStorage.setItem(STORAGE_KEY, JSON.stringify(user.value));
  return user.value;
}

function logout() {
  user.value = null;
  localStorage.removeItem(STORAGE_KEY);
}

function getCurrentUser() { return user.value; }
function hasRole(role) { return !!user.value && user.value.role === role; }
function isLoggedIn() { return !!user.value; }

export const isMockAuth = true;

export function useAuth() {
  return { user, login, logout, hasRole, isLoggedIn, mockUsers };
}

export default { login, logout, getCurrentUser, hasRole, isLoggedIn };