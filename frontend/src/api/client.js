export const baseURL = import.meta.env.VITE_API_BASE_URL || 'http://127.0.0.1:8000/api/v1';

async function apiFetch(path, options = {}) {
  const res = await fetch(`${baseURL}${path}`, {
    headers: { 'Content-Type': 'application/json', ...(options.headers || {}) },
    ...options,
  });
  if (!res.ok) {
    let text;
    try { text = await res.text(); } catch {}
    throw new Error(`HTTP ${res.status}: ${text || res.statusText}`);
  }
  const contentType = res.headers.get('content-type') || '';
  if (contentType.includes('application/json')) {
    return res.json();
  }
  return res.text();
}

export const MesasApi = {
  list: (query = '') => apiFetch(`/mesas${query}`),
  create: (payload) => apiFetch('/mesas', { method: 'POST', body: JSON.stringify(payload) }),
  update: (id, payload) => apiFetch(`/mesas/${id}`, { method: 'PUT', body: JSON.stringify(payload) }),
  ocupar: (id) => apiFetch(`/mesas/${id}/ocupar`, { method: 'PATCH' }),
  liberar: (id) => apiFetch(`/mesas/${id}/liberar`, { method: 'PATCH' }),
  destroy: (id) => apiFetch(`/mesas/${id}`, { method: 'DELETE' }),
};

export const InsumosApi = {
  list: (query = '') => apiFetch(`/inventario/insumos${query}`),
  create: (payload) => apiFetch('/inventario/insumos', { method: 'POST', body: JSON.stringify(payload) }),
  update: (id, payload) => apiFetch(`/inventario/insumos/${id}`, { method: 'PUT', body: JSON.stringify(payload) }),
  destroy: (id) => apiFetch(`/inventario/insumos/${id}`, { method: 'DELETE' }),
  restore: (id) => apiFetch(`/inventario/insumos/${id}/restore`, { method: 'PATCH' }),
};

export const PedidosApi = {
  list: (query = '') => apiFetch(`/pedidos${query}`),
  create: (payload) => apiFetch('/pedidos', { method: 'POST', body: JSON.stringify(payload) }),
  update: (id, payload) => apiFetch(`/pedidos/${id}`, { method: 'PUT', body: JSON.stringify(payload) }),
  cerrar: (id) => apiFetch(`/pedidos/${id}/cerrar`, { method: 'PATCH' }),
  abrir: (id) => apiFetch(`/pedidos/${id}/abrir`, { method: 'PATCH' }),
  cancelar: (id) => apiFetch(`/pedidos/${id}/cancelar`, { method: 'PATCH' }),
  destroy: (id) => apiFetch(`/pedidos/${id}`, { method: 'DELETE' }),
};