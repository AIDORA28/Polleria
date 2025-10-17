# Guía de actualización del proyecto

Monorepo con `backend` (Laravel) y `frontend` (Vite + Vue). Esta guía explica cómo actualizar tu entorno local cuando otro integrante hizo cambios, cómo continuar con tu módulo y comandos útiles de Git.

## Objetivo
- Mantener tu copia local sincronizada con el repositorio remoto.
- Actualizar dependencias y esquemas (migraciones) del backend.
- Reiniciar y validar el frontend cuando cambien dependencias o el contrato de la API.
- Trabajar de forma modular sin mezclar cambios no relacionados.

## Requisitos previos
- Git instalado y configurado (`git --version`).
- PHP y Composer instalados para el backend.
- Node.js y npm instalados para el frontend.
- Archivo de entorno local: `backend/.env` y `frontend/.env` (no se deben subir al repo).

## Flujo para actualizar tu copia local
1. Revisa tu estado actual:
   ```bash
   git status
   ```
2. Si tienes trabajo sin commit, guarda temporalmente (opcional):
   ```bash
   git stash push -m "wip: trabajo en curso" --include-untracked
   ```
3. Trae los últimos cambios del remoto (recomendado con rebase):
   ```bash
   git pull --rebase origin main
   ```
   - Si trabajas en otra rama: `git pull --rebase origin <tu_rama>`.
4. Backend: instala dependencias y aplica cambios:
   ```bash
   cd backend
   composer install
   php artisan migrate       # si hay nuevas migraciones
   php artisan config:clear  # aplicar cambios en config/CORS u otros
   php artisan cache:clear   # opcional
   php artisan route:clear   # opcional
   ```
   - Si cambiaron variables de entorno, actualiza tu `backend/.env` (basado en `backend/.env.example`).
5. Frontend: instala dependencias y reinicia el servidor de desarrollo:
   ```bash
   cd ../frontend
   npm install
   # Si el dev server estaba corriendo, detén y vuelve a iniciar
   npm run dev
   ```
   - Verifica `frontend/.env` (usa `frontend/.env.example` como referencia). 
   - Asegúrate de que `VITE_API_BASE_URL` apunte a tu backend local o remoto correcto.

## Actualizar el módulo en el que hiciste cambios
- Crea una rama de feature (ejemplo para Mesas):
  ```bash
  git checkout -b feat/mesas-ui
  ```
- Edita solo los archivos del módulo (ej.: `frontend/src/pages/Mesas.vue`).
- Prueba localmente el frontend (`npm run dev`) y el backend.
- Haz staging solo de los archivos relevantes:
  ```bash
  git add frontend/src/pages/Mesas.vue
  # (agrega otros archivos del módulo si aplican)
  ```
- Commit claro siguiendo convenciones:
  ```bash
  git commit -m "feat(mesas): ajustes UI y acciones"
  ```
- Sube la rama y abre PR:
  ```bash
  git push -u origin feat/mesas-ui
  ```

## Resolución de conflictos
- Al hacer `pull --rebase` o `merge`, si ves marcadores `<<<<<<< HEAD`:
  - Edita los archivos para resolver, decide qué cambios mantener.
  - Continúa el rebase:
    ```bash
    git add <archivo_resuelto>
    git rebase --continue
    ```
  - Si te bloqueas: `git rebase --abort` y consulta con el equipo.
- Con `merge`:
  ```bash
  git merge origin/main
  # resolver conflictos
  git add <archivos>
  git commit
  ```

## Comandos Git útiles
- Ver estado: `git status`
- Traer sin mezclar commits locales: `git pull --rebase`
- Stash de trabajo en curso: `git stash push --include-untracked`
- Ver y recuperar stash: `git stash list`, `git stash pop`
- Staging parcial (por hunk): `git add -p`
- Deshacer staging: `git restore --staged <ruta>`
- Modificar el último commit (sin cambiar mensaje): `git commit --amend --no-edit`
- Revertir un commit publicado: `git revert <hash>`
- Reset duro del último commit (CUIDADO): `git reset --hard HEAD~1`
- Ver historial de referencias: `git reflog`
- Cambiar a rama principal: `git branch -M main`
- Remotos: `git remote -v`, `git remote set-url origin <url>`
- Traer todo y rebasar contra main: `git fetch --all`, `git rebase origin/main`

## Entornos y CORS
- No subas `.env` al repositorio. Usa los `.env.example` como base.
- Si se actualiza CORS (dominios permitidos), limpia la configuración:
  ```bash
  cd backend
  php artisan config:clear
  ```
- Para consumir API remota en el frontend, ajusta:
  ```bash
  # frontend/.env
  VITE_API_BASE_URL=https://api.tu-dominio.com/api/v1
  ```
  Verifica que el backend permita tu origen en `config/cors.php`.

## Convenciones de ramas y commits
- Ramas: `feat/<feature>`, `fix/<bug>`, `chore/<tarea>`, `docs/<documentación>`.
- Mensajes de commit (ejemplos):
  - `feat(mesas): crear acciones de ocupar y liberar`
  - `fix(insumos): corregir filtro only_trashed`
  - `chore(dev): actualizar dependencias del frontend`

## Atajo de actualización (resumen)
```bash
# desde la raíz del repo
git status
# si tienes cambios locales sin commit:
git stash push -m "wip" --include-untracked

git pull --rebase origin main

cd backend && composer install && php artisan migrate && php artisan config:clear
cd ../frontend && npm install
# reinicia el dev server si estaba corriendo
npm run dev
```

## Notas finales
- Si cambió el contrato de la API, revisa `frontend/src/api/client.js` y ajusta las funciones afectadas.
- Si el backend cambió rutas o parámetros, valida con `php artisan route:list` y actualiza el cliente del frontend.
- Documenta cambios relevantes en `README.md` o en esta guía para el equipo.