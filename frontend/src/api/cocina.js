// API mock para módulo de cocina

const delay = (ms) => new Promise(res => setTimeout(res, ms))

const cocinaApi = {
  async fetchPendientes() {
    await delay(200)
    return [
      { id: 101, mesa: 3, items: ['Pollo a la brasa', 'Papas'], estado: 'Pendiente' },
      { id: 102, mesa: 5, items: ['Chicha morada', 'Ensalada'], estado: 'Pendiente' },
      { id: 103, mesa: 1, items: ['Alitas BBQ', 'Arroz'], estado: 'Pendiente' },
    ]
  },
  async fetchEnPreparacion() {
    await delay(200)
    return [
      { id: 201, mesa: 7, items: ['Pollo 1/4', 'Inca Kola'], estado: 'Preparando' },
      { id: 202, mesa: 2, items: ['Sopa', 'Pan'], estado: 'Preparando' },
    ]
  },
  async fetchListos() {
    await delay(200)
    return [
      { id: 301, mesa: 4, items: ['Pollo entero', 'Papas'], estado: 'Listo' },
      { id: 302, mesa: 6, items: ['Pechuga a la plancha', 'Ensalada'], estado: 'Listo' },
    ]
  },
  async fetchRecetas() {
    await delay(200)
    return [
      { id: 1, nombre: 'Pollo a la Brasa', tiempo: 45, ingredientes: ['Pollo', 'Sal', 'Ají', 'Carbón'] },
      { id: 2, nombre: 'Papas Fritas', tiempo: 12, ingredientes: ['Papa', 'Aceite', 'Sal'] },
      { id: 3, nombre: 'Ensalada', tiempo: 8, ingredientes: ['Lechuga', 'Tomate', 'Cebolla'] },
    ]
  },
  async fetchInventario() {
    await delay(200)
    return [
      { id: 10, nombre: 'Pollo', stock: 24, unidad: 'unidades', estado: 'OK' },
      { id: 11, nombre: 'Papa', stock: 5, unidad: 'kg', estado: 'Bajo' },
      { id: 12, nombre: 'Carbón', stock: 2, unidad: 'sacos', estado: 'Crítico' },
    ]
  },
  async fetchTiempos() {
    await delay(200)
    return {
      promedio: 18,
      minimo: 8,
      maximo: 42,
      buckets: [
        { label: '0-10 min', count: 12 },
        { label: '10-20 min', count: 23 },
        { label: '20-30 min', count: 9 },
        { label: '30+ min', count: 4 },
      ]
    }
  }
}

export default cocinaApi