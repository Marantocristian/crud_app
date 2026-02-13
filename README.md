# CRUD APP (Laravel + PostgreSQL)

Aplicacion web CRUD para gestion de clientes.

## Stack del proyecto

- PHP 8.2+
- Laravel 12
- PostgreSQL 12+
- Node.js 18+ (recomendado 20 LTS)
- Vite (assets frontend)

## Requisitos previos

Instala en la maquina destino:

- Git
- PHP 8.2 o superior
- Composer
- PostgreSQL
- Node.js y npm

Verifica versiones:

```bash
php -v
composer -V
psql --version
node -v
npm -v
```

## 1) Clonar el repositorio

```bash
git clone https://github.com/Marantocristian/crud_app.git
cd crud_app
```

## 2) Instalar dependencias

Dependencias PHP:

```bash
composer install
```

## 3) Crear base de datos en PostgreSQL

1. Crea `.env` desde el ejemplo:

Linux/macOS:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

2. Configura credenciales PostgreSQL en `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=crud_app
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

3. Crea la base:

```sql
CREATE DATABASE crud_app;
```

4. Elige una opcion:

- Opcion A (recomendada, desde cero): ejecutar migraciones

```bash
php artisan migrate
```

- Opcion B (usar backup del proyecto): restaurar dump `backup_db/crud_app`

```powershell
psql -h 127.0.0.1 -p 5432 -U tu_usuario -d crud_app -f .\backup_db\crud_app
```

5. Si restauraste backup, limpia cache:

```bash
php artisan optimize:clear
```

Si usas backup completo, no ejecutes `php artisan migrate` despues (para evitar duplicados). Si no usas backup, si debes ejecutar migraciones.

## 4) Generar la clave de aplicacion

```bash
php artisan key:generate
```

## 5) Levantar el proyecto
```bash
php artisan serve
```

Abrir:

- http://127.0.0.1:8000

## Rutas principales

- `GET /` redirige a listado de clientes
- `GET /clientes` listado
- `GET /clientes/crear` formulario crear
- `POST /clientes` guardar
- `GET /clientes/{cliente}` detalle
- `GET /clientes/{cliente}/editar` formulario editar
- `PUT /clientes/{cliente}` actualizar
- `DELETE /clientes/{cliente}` eliminar

## Errores comunes y solucion

### Error: `Undefined table "sessions"`

Causa: `SESSION_DRIVER=database` y falta la tabla `sessions`.

Solucion:

```bash
php artisan migrate
php artisan optimize:clear
```

### Error de conexion a PostgreSQL

Verificar:

- Servicio PostgreSQL encendido
- Credenciales correctas en `.env`
- Base de datos existente (`crud_app`)
- Puerto correcto (`5432`)

### Cambios en `.env` no se reflejan

Limpiar cache de Laravel:

```bash
php artisan optimize:clear
```

## Comandos utiles

```bash
php artisan route:list
php artisan test
php artisan migrate:fresh --seed
```

## Estructura base

```text
app/Http/Controllers/ClienteController.php
app/Models/ClienteModel.php
resources/views/clientes/
routes/web.php
database/migrations/
backup_db/crud_app
```

## Notas

- El proyecto usa PostgreSQL por defecto.
- Si vas a levantarlo en otra maquina, no copies `.env`; crea uno nuevo desde `.env.example`.
