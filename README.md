# PolleriaV1 – Monorepo

Proyecto modular con:
- `backend` (Laravel)
- `frontend` (Vite + Vue)

## Enlaces útiles
- Guía de actualización y flujo de trabajo: `DOC/Guia-Actualizacion.md`

## Inicio rápido
- Backend (Laravel):
  ```bash
  cd backend
  composer install
  php artisan migrate
  php artisan config:clear
  php artisan serve --host=127.0.0.1 --port=8000
  ```
- Frontend (Vite + Vue):
  ```bash
  cd frontend
  npm install
  # Configura tu entorno
  # Si necesitas crear el archivo:
  # PowerShell:  copy .env.example .env
  # Bash:        cp .env.example .env
  # Ajusta VITE_API_BASE_URL según tu backend
  npm run dev
  ```

## Flujo de trabajo por módulos
- Trabaja en ramas de feature: `feat/<modulo>` (ej.: `feat/mesas-ui`).
- Staging selectivo solo de archivos del módulo (ej.: `frontend/src/pages/Mesas.vue`).
- Commits claros y pequeños.
- Revisa la guía: `DOC/Guia-Actualizacion.md` para actualización, rebase, conflictos y comandos.

## Checklist para Pull Requests (PR)
- Rama con convención: `feat/`, `fix/`, `chore/`, `docs/`.
- Mensaje de commit claro (ej.: `feat(mesas): ajustes UI y acciones`).
- Solo incluye cambios del módulo/feature (evita ruido).
- Backend:
  - Ejecuta `composer install` si agregaste dependencias.
  - Ejecuta `php artisan migrate` si agregaste migraciones.
  - Verifica rutas con `php artisan route:list` si cambiaste endpoints.
  - No subas `backend/.env`.
- Frontend:
  - Ejecuta `npm install` si agregaste dependencias.
  - Actualiza `frontend/.env.example` si cambió el contrato de la API.
  - No subas `frontend/.env`.
- Documentación: enlaza o actualiza `DOC/Guia-Actualizacion.md` si tu cambio afecta el flujo.
- CORS: si cambiaste orígenes permitidos en backend (`config/cors.php`), limpia configuración: `php artisan config:clear`.

## Notas
- Usa `git pull --rebase` para mantener historial limpio.
- Si tu entorno rompe tras actualizar, sigue el atajo de la guía:
  ```bash
  git stash push -m "wip" --include-untracked
  git pull --rebase origin main
  cd backend && composer install && php artisan migrate && php artisan config:clear
  cd ../frontend && npm install && npm run dev
  ```
- Evita subir `vendor`, `node_modules` y `.env`. El repositorio ya incluye `.gitignore` para esto.