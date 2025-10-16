<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pollería - Modelo UI</title>
    @vite(['resources/css/app.css'])
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif; }
        header { padding: 12px 16px; border-bottom: 1px solid #ddd; display: flex; gap: 12px; align-items: center; }
        main { padding: 16px; }
        .container { max-width: 980px; margin: 0 auto; }
        .grid { display: grid; gap: 12px; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 12px; }
        .row { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
        button { padding: 6px 10px; border: 1px solid #ccc; border-radius: 6px; background: #fff; cursor: pointer; }
        button.primary { background: #2563eb; color: #fff; border-color: #1e40af; }
        input, select, textarea { padding: 6px 8px; border: 1px solid #ccc; border-radius: 6px; }
        .muted { color: #6b7280; }
        .right { text-align: right; }
    </style>
</head>
<body>
<header>
    <strong>Pollería</strong>
    <nav class="row">
        <a href="/ui" class="muted">Inicio</a>
        <a href="/ui/mesas" class="muted">Mesas</a>
        <a href="/ui/insumos" class="muted">Insumos</a>
        <a href="/ui/pedidos" class="muted">Pedidos</a>
    </nav>
</header>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
</body>
</html>