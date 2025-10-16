@extends('layouts.app')

@section('content')
<div class="grid">
    <div class="card">
        <h2>Pedidos</h2>
        <div class="row">
            <label>Mesa <input id="p-mesa" type="text" placeholder="A1"></label>
            <label>Sucursal <input id="p-sucursal" type="number" placeholder="1"></label>
        </div>
        <div class="row">
            <label style="flex:1">Items (JSON)
                <textarea id="p-items" rows="3" style="width:100%">[{"producto":"Pollo a la brasa","cantidad":1}]</textarea>
            </label>
        </div>
        <div class="row">
            <button class="primary" onclick="crearPedido()">Crear</button>
            <button onclick="cargarPedidos()">Cargar</button>
        </div>
        <hr>
        <div class="row">
            <label>Filtro mesa <input id="f-mesa" type="text"></label>
            <label>Filtro sucursal <input id="f-sucursal" type="number"></label>
            <label>Estado <select id="f-estado"><option value="">(todos)</option><option value="abierto">abierto</option><option value="cerrado">cerrado</option></select></label>
            <label>Orden por <select id="f-sortby"><option value="id">id</option><option value="mesa">mesa</option><option value="estado">estado</option><option value="sucursal_id">sucursal_id</option></select></label>
            <label>Dirección <select id="f-sortdir"><option value="desc">desc</option><option value="asc">asc</option></select></label>
            <label>Per page <input id="f-per" type="number" placeholder=""></label>
            <button onclick="cargarPedidos()">Buscar</button>
        </div>
    </div>

    <div class="card">
        <table id="pedidos-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Mesa</th>
                <th>Sucursal</th>
                <th>Estado</th>
                <th>Items</th>
                <th class="right">Acciones</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
function buildQueryP() {
    const q = new URLSearchParams();
    const mesa = document.getElementById('f-mesa').value.trim();
    const suc = document.getElementById('f-sucursal').value;
    const estado = document.getElementById('f-estado').value;
    const sortBy = document.getElementById('f-sortby').value;
    const sortDir = document.getElementById('f-sortdir').value;
    const per = document.getElementById('f-per').value;
    if (mesa) q.set('mesa', mesa);
    if (suc) q.set('sucursal_id', Number(suc));
    if (estado) q.set('estado', estado);
    if (sortBy) q.set('sort_by', sortBy);
    if (sortDir) q.set('sort_dir', sortDir);
    if (per) q.set('per_page', Number(per));
    return q.toString();
}

async function cargarPedidos() {
    const q = buildQueryP();
    const res = await fetch('/api/v1/pedidos' + (q ? ('?' + q) : ''));
    const data = await res.json();
    const items = Array.isArray(data) ? data : (data.data || []);
    const tbody = document.querySelector('#pedidos-table tbody');
    tbody.innerHTML = '';
    items.forEach(p => {
        const tr = document.createElement('tr');
        const itemsTxt = JSON.stringify(p.items ?? []);
        tr.innerHTML = `
          <td>${p.id}</td>
          <td>${p.mesa ?? ''}</td>
          <td>${p.sucursal_id ?? ''}</td>
          <td>${p.estado ?? ''}</td>
          <td><pre style="white-space:pre-wrap">${itemsTxt}</pre></td>
          <td class="right">
            <button onclick="editarPedido(${p.id}, '${p.mesa ?? ''}', '${itemsTxt.replace(/"/g, '&quot;')}')">Editar</button>
            <button onclick="cerrarPedido(${p.id})">Cerrar</button>
            <button onclick="abrirPedido(${p.id})">Abrir</button>
            <button onclick="cancelarPedido(${p.id})">Cancelar</button>
            <button onclick="borrarPedido(${p.id})">Eliminar</button>
          </td>`;
        tbody.appendChild(tr);
    });
}

async function crearPedido() {
    const mesa = document.getElementById('p-mesa').value.trim();
    const suc = document.getElementById('p-sucursal').value;
    let itemsJson = document.getElementById('p-items').value.trim();
    try { itemsJson = JSON.parse(itemsJson || '[]'); } catch(e) { alert('Items JSON inválido'); return; }
    const res = await fetch('/api/v1/pedidos', {
        method: 'POST', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mesa, sucursal_id: suc ? Number(suc) : null, items: itemsJson })
    });
    if (res.ok) { cargarPedidos(); } else { alert('Error al crear'); }
}

async function editarPedido(id, mesaActual, itemsActual) {
    const mesa = prompt('Nueva mesa', mesaActual ?? '') ?? '';
    let itemsTxt = prompt('Items (JSON)', itemsActual ?? '[]') ?? '[]';
    let itemsJson;
    try { itemsJson = JSON.parse(itemsTxt || '[]'); } catch(e) { alert('Items JSON inválido'); return; }
    const res = await fetch(`/api/v1/pedidos/${id}`, {
        method: 'PUT', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mesa, items: itemsJson })
    });
    if (res.ok) { cargarPedidos(); } else { const t = await res.json(); alert(t.error || 'Error al editar'); }
}

async function cerrarPedido(id) {
    const res = await fetch(`/api/v1/pedidos/${id}/cerrar`, { method: 'PATCH' });
    if (res.ok) { cargarPedidos(); } else { alert('Error al cerrar'); }
}
async function abrirPedido(id) {
    const res = await fetch(`/api/v1/pedidos/${id}/abrir`, { method: 'PATCH' });
    if (res.ok) { cargarPedidos(); } else { const t = await res.json(); alert(t.error || 'Error'); }
}
async function cancelarPedido(id) {
    const res = await fetch(`/api/v1/pedidos/${id}/cancelar`, { method: 'PATCH' });
    if (res.ok) { cargarPedidos(); } else { const t = await res.json(); alert(t.error || 'Error'); }
}
async function borrarPedido(id) {
    if (!confirm('¿Eliminar pedido?')) return;
    const res = await fetch(`/api/v1/pedidos/${id}`, { method: 'DELETE' });
    if (res.ok) { cargarPedidos(); } else { alert('Error al eliminar'); }
}

window.addEventListener('DOMContentLoaded', cargarPedidos);
</script>
@endsection