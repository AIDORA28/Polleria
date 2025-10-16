@extends('layouts.app')

@section('content')
<div class="grid">
    <div class="card">
        <h2>Insumos</h2>
        <div class="row">
            <label>Nombre <input id="i-name" type="text" placeholder="Pollo"></label>
            <label>Sucursal <input id="i-sucursal" type="number" placeholder="1"></label>
            <button class="primary" onclick="crearInsumo()">Crear</button>
        </div>
        <div class="row">
            <label>Filtro nombre <input id="f-name" type="text" placeholder=""></label>
            <label>Filtro sucursal <input id="f-sucursal" type="number" placeholder=""></label>
            <label>Orden por 
                <select id="f-sortby">
                    <option value="id">id</option>
                    <option value="name">name</option>
                    <option value="sucursal_id">sucursal_id</option>
                </select>
            </label>
            <label>Dirección <select id="f-sortdir"><option value="desc">desc</option><option value="asc">asc</option></select></label>
            <label><input id="f-with" type="checkbox"> with_trashed</label>
            <label><input id="f-only" type="checkbox"> only_trashed</label>
            <button onclick="cargarInsumos()">Buscar</button>
        </div>
    </div>

    <div class="card">
        <table id="insumos-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Sucursal</th>
                <th class="right">Acciones</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
function buildQuery() {
    const q = new URLSearchParams();
    const name = document.getElementById('f-name').value.trim();
    const suc = document.getElementById('f-sucursal').value;
    const sortBy = document.getElementById('f-sortby').value;
    const sortDir = document.getElementById('f-sortdir').value;
    const withTr = document.getElementById('f-with').checked;
    const onlyTr = document.getElementById('f-only').checked;
    if (name) q.set('name', name);
    if (suc) q.set('sucursal_id', Number(suc));
    if (sortBy) q.set('sort_by', sortBy);
    if (sortDir) q.set('sort_dir', sortDir);
    if (withTr) q.set('with_trashed', '1');
    if (onlyTr) q.set('only_trashed', '1');
    return q.toString();
}

async function cargarInsumos() {
    const q = buildQuery();
    const res = await fetch('/api/v1/inventario/insumos' + (q ? ('?' + q) : ''));
    const data = await res.json();
    const items = Array.isArray(data) ? data : (data.data || []);
    const tbody = document.querySelector('#insumos-table tbody');
    const only = document.getElementById('f-only').checked;
    tbody.innerHTML = '';
    items.forEach(i => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${i.id}</td>
          <td>${i.name ?? ''}</td>
          <td>${i.sucursal_id ?? ''}</td>
          <td class="right">
            <button onclick="editarInsumo(${i.id}, '${i.name ?? ''}')">Editar</button>
            <button onclick="borrarInsumo(${i.id})">Eliminar</button>
            ${only ? `<button onclick="restaurarInsumo(${i.id})">Restaurar</button>` : ''}
          </td>`;
        tbody.appendChild(tr);
    });
}

async function crearInsumo() {
    const name = document.getElementById('i-name').value.trim();
    const suc = document.getElementById('i-sucursal').value;
    if (!name) { alert('Nombre requerido'); return; }
    const res = await fetch('/api/v1/inventario/insumos', {
        method: 'POST', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, sucursal_id: suc ? Number(suc) : null })
    });
    if (res.ok) { cargarInsumos(); } else { alert('Error al crear'); }
}

async function editarInsumo(id, nombreActual) {
    const name = prompt('Nuevo nombre', nombreActual ?? '') ?? '';
    const res = await fetch(`/api/v1/inventario/insumos/${id}`, {
        method: 'PUT', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name })
    });
    if (res.ok) { cargarInsumos(); } else { alert('Error al editar'); }
}

async function borrarInsumo(id) {
    if (!confirm('¿Eliminar insumo?')) return;
    const res = await fetch(`/api/v1/inventario/insumos/${id}`, { method: 'DELETE' });
    if (res.ok) { cargarInsumos(); } else { alert('Error al eliminar'); }
}

async function restaurarInsumo(id) {
    const res = await fetch(`/api/v1/inventario/insumos/${id}/restore`, { method: 'POST' });
    if (res.ok) { cargarInsumos(); } else { alert('Error al restaurar'); }
}

window.addEventListener('DOMContentLoaded', cargarInsumos);
</script>
@endsection