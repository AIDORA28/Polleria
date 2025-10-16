@extends('layouts.app')

@section('content')
<div class="grid">
    <div class="card">
        <h2>Mesas</h2>
        <div class="row">
            <label>Número <input id="m-numero" type="text" placeholder="A1"></label>
            <label>Sucursal <input id="m-sucursal" type="number" placeholder="1"></label>
            <button class="primary" onclick="crearMesa()">Crear</button>
            <button onclick="cargarMesas()">Cargar</button>
        </div>
    </div>

    <div class="card">
        <table id="mesas-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Sucursal</th>
                <th>Número</th>
                <th>Estado</th>
                <th class="right">Acciones</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
async function cargarMesas() {
    const res = await fetch('/api/v1/mesas');
    const data = await res.json();
    const tbody = document.querySelector('#mesas-table tbody');
    tbody.innerHTML = '';
    data.forEach(m => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${m.id}</td>
          <td>${m.sucursal_id ?? ''}</td>
          <td>${m.numero ?? ''}</td>
          <td>${m.estado ?? ''}</td>
          <td class="right">
            <button onclick="editarMesa(${m.id}, '${m.numero ?? ''}')">Editar</button>
            <button onclick="ocuparMesa(${m.id})">Ocupar</button>
            <button onclick="liberarMesa(${m.id})">Liberar</button>
            <button onclick="borrarMesa(${m.id})">Eliminar</button>
          </td>`;
        tbody.appendChild(tr);
    });
}

async function crearMesa() {
    const numero = document.getElementById('m-numero').value.trim();
    const sucursal = document.getElementById('m-sucursal').value;
    if (!numero) { alert('Número requerido'); return; }
    const res = await fetch('/api/v1/mesas', {
        method: 'POST', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ numero, sucursal_id: sucursal ? Number(sucursal) : null })
    });
    if (res.ok) { cargarMesas(); } else { alert('Error al crear'); }
}

async function editarMesa(id, numeroActual) {
    const numero = prompt('Nuevo número', numeroActual ?? '') ?? '';
    const res = await fetch(`/api/v1/mesas/${id}`, {
        method: 'PUT', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ numero })
    });
    if (res.ok) { cargarMesas(); } else { alert('Error al editar'); }
}

async function ocuparMesa(id) {
    const res = await fetch(`/api/v1/mesas/${id}/ocupar`, { method: 'PATCH' });
    if (res.ok) { cargarMesas(); } else { alert('Error al ocupar'); }
}

async function liberarMesa(id) {
    const res = await fetch(`/api/v1/mesas/${id}/liberar`, { method: 'PATCH' });
    if (res.ok) { cargarMesas(); } else { alert('Error al liberar'); }
}

async function borrarMesa(id) {
    if (!confirm('¿Eliminar mesa?')) return;
    const res = await fetch(`/api/v1/mesas/${id}`, { method: 'DELETE' });
    if (res.ok) { cargarMesas(); } else { alert('Error al eliminar'); }
}

window.addEventListener('DOMContentLoaded', cargarMesas);
</script>
@endsection