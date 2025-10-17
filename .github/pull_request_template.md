## Título
Breve y claro. Ejemplo: `feat(mesas): acciones de ocupar/liberar y mejoras UI`.

## Resumen
- ¿Qué cambia y por qué?
- ¿Qué módulos afecta? (`backend`, `frontend`, ambos)
- ¿Hay cambios de contrato de API? (endpoints, payload, estados)

## Checklist
- [ ] Rama con convención (`feat/`, `fix/`, `chore/`, `docs/`)
- [ ] Commits claros y pequeños
- [ ] No subí `.env` ni secretos (backend/frontend)
- [ ] Actualicé `frontend/.env.example` si cambió `VITE_API_BASE_URL`
- [ ] Si cambié CORS: limpié config (`php artisan config:clear`) y documenté orígenes
- [ ] Si agregué dependencias backend: `composer install` probado
- [ ] Si agregué migraciones: `php artisan migrate` probado
- [ ] Si cambié rutas backend: validé con `php artisan route:list`
- [ ] Si agregué dependencias frontend: `npm install` probado
- [ ] Probado localmente backend + frontend (`npm run dev`) sin errores
- [ ] Documenté pasos de actualización en `DOC/Guia-Actualizacion.md` si aplica

## Cómo probar
Describe pasos reproducibles:
1. Backend
   ```bash
   cd backend
   composer install
   php artisan migrate
   php artisan serve --host=127.0.0.1 --port=8000
   ```
2. Frontend
   ```bash
   cd frontend
   npm install
   # PowerShell:  copy .env.example .env
   # Bash:        cp .env.example .env
   # Ajustar VITE_API_BASE_URL si corresponde
   npm run dev
   ```
3. Navegar a la página/módulo afectado y verificar escenarios:
   - [ ] Caso feliz
   - [ ] Validaciones/errores
   - [ ] Estados (abierto/cerrado/cancelado, etc.)

## Impacto y riesgos
- ¿Hay breaking changes? Sí/No
- ¿Afecta datos (migraciones destructivas)? Sí/No
- ¿Requiere configuración adicional (CORS, env, claves)? Sí/No

## Notas/adjuntos
- Capturas, logs, referencias a issues o discusiones