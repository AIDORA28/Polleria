// ESTRUCTURA DE PROYECTO MODULAR (PHP LARAVEL & VUE/REACT)

Sistema de Pollería (POS/ERP ligero) basado en **Laravel** (Backend) y **Vue/React** (Frontend). Arquitectura modular por dominio, con separación de responsabilidades y preparada para multi‑sucursal.

**Principios MVP (solo lo necesario y funcional)**
- Prioridad funcional: define un MVP y no salir de ese alcance.
- Evitar abstracciones prematuras: no crear capas/patrones que no se usan hoy.
- Simplicidad legible: código explícito y fácil de entender por otro dev.
- No reinventar la rueda: librerías estándar con dependencias mínimas y justificadas.
- Entrega iterativa: primero un artefacto funcional; mejoras en nuevas historias.
- Pruebas básicas: unitarias/smoke que verifiquen lo esencial funciona.
- Documentación mínima: README de cómo ejecutar, inputs/outputs y decisiones clave.

---

### A. BACKEND (LARAVEL)

Usa estructura por defecto de Laravel y añade `app/Modules` para la lógica por dominio. Cada módulo contiene solo lo esencial (Controllers, Models, Routes y, si aplica, Migrations).

**Core mínimo (transversal):**
- `app/Http/Middleware`: autenticación y sucursal activa (cuando se use).
- `database/migrations/core`: tablas esenciales (`users`, `roles`, `sucursales`).
- Evita servicios/abstractas hasta que haya una necesidad real.

**Módulos por dominio:**
- `app/Modules/[Nombre_Modulo]`: carpeta por módulo autocontenido.
- Incluye solo lo necesario: `Http/Controllers`, `Models`, `Routes/api.php`, `Database/Migrations` (si requiere persistencia).
- Registra rutas y migraciones con un Service Provider del módulo.

### B. FRONTEND (VUE/REACT)

SPA dividida por aplicaciones (Caja, Meseros, Cocina) y componentes reutilizables.

**Global mínimo:**
- `src/api`: cliente HTTP (axios/fetch) con token y `sucursal_id`.
- `src/router`: rutas por aplicación y layouts básicos.
- `src/assets`: estilos/imagenes.

**Reutilizables:**
- `src/components/common`: UI genérica (botón, modal).
- `src/components/shared`: componentes de negocio reutilizables (SelectorSucursal, Sidebar).

---

### C. Plantilla de Módulo (Laravel)

Estructura mínima para crear módulos de forma consistente, sin sobre‑ingeniería:

```
app/Modules/_ModuleTemplate/
  Http/Controllers/HealthController.php
  Models/TemplateItem.php (opcional según dominio)
  Routes/api.php
  Database/Migrations/2025_10_15_000000_create_template_items_table.php (opcional)
  Providers/ModuleTemplateServiceProvider.php
```

**Convenciones:**
- Prefijos: `api/v1/<modulo>` para endpoints.
- Middleware: usar grupo `api` por defecto.
- Migrations: incluir `sucursal_id` cuando aplique filtrado por sucursal.
- Tests: `tests/Feature/Modules/<Modulo>` con al menos un smoke test de rutas.

**Cómo usar la plantilla (aplicar plantillas):**
1) Copiar `app/Modules/_ModuleTemplate` a `app/Modules/<TuModulo>` y reemplazar nombres.
2) Registrar el provider del módulo en `bootstrap/providers.php`.
3) (Opcional) Crear migraciones necesarias dentro de `Database/Migrations` del módulo.
4) Ejecutar: `php artisan migrate`.
5) Probar endpoint de salud: `GET /api/v1/<tu-modulo>/health` debe responder `{ status: "ok" }`.

---

### D. MVP sugerido (alcance mínimo)
- Seguridad básica (login) y selección de sucursal activa.
- Inventario mínimo: catálogo de insumos (altas/bajas simples).
- Pedidos mínimos: crear y listar pedidos con items.
- Cocina tiempo real: canal simple de nuevas comandas (placeholder).

Post‑MVP: Kardex avanzado, roles/permisos detallados, reportes y cierre de caja.

---

### E. Pruebas y documentación
- Pruebas: añadir smoke tests por módulo (rutas responden 200/JSON esperado).
- Documentación: README con cómo ejecutar, variables `.env`, y decisiones clave.

---

### F. Notas de implementación
- Evita extraer servicios/traits si no hay reutilización hoy.
- Usa dependencias estándar (Laravel, Axios/Fetch, Echo/Socket.io si aplica) y mínimas.
- Alias de imports (frontend) y PSR‑4 por defecto (backend) para claridad.