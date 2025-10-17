---
name: Solicitud de feature
about: Propón una mejora o nueva funcionalidad
title: "feat: <resumen de la propuesta>"
labels: enhancement
assignees: ''
---

## Problema a resolver
Describe el problema del usuario o del negocio.

## Propuesta
Explica la solución propuesta y cómo se integrará (backend/frontend).

## Alcance
- Pantallas/módulos afectados
- Endpoints nuevos o cambios de contrato (si aplica)
- Datos/migraciones requeridas

## Criterios de aceptación
- [ ] Escenario 1 ...
- [ ] Escenario 2 ...

## Dependencias
- Otros PRs/Issues relacionados
- Librerías o servicios externos

## Alternativas consideradas
Otras opciones y por qué se descartan.

## Notas de implementación
- Cambios en `frontend/.env.example` o `VITE_API_BASE_URL`
- CORS: orígenes necesarios en `config/cors.php`
- Pruebas: cómo validar en local (`npm run dev`, `php artisan serve`)