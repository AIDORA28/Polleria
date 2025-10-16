@extends('layouts.app')

@section('content')
<div class="grid">
    <div class="card">
        <h2>Modelo UI</h2>
        <p class="muted">Páginas de demostración para Mesas, Inventario (Insumos) y Pedidos.</p>
    </div>

    <div class="row">
        <a href="/ui/mesas"><button class="primary">Ir a Mesas</button></a>
        <a href="/ui/insumos"><button class="primary">Ir a Insumos</button></a>
        <a href="/ui/pedidos"><button class="primary">Ir a Pedidos</button></a>
    </div>
</div>
@endsection