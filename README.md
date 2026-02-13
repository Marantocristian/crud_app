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

```bash
composer install
```

## 3) Configuracion de Base de Datos (PostgreSQL)

En este proyecto tienes dos formas de configurar la base de datos.

### A) Instalacion desde cero (recomendada)

1. Crear la base de datos en PostgreSQL:

```sql
CREATE DATABASE crud_app;
```

2. Crear el archivo `.env` desde el ejemplo:

Linux/macOS:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

3. Configurar correctamente las credenciales en `.env`:

```env
APP_NAME=CRUD_APP
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=crud_app
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

4. Generar la clave de aplicacion:

```bash
php artisan key:generate
```

5. Ejecutar migraciones para crear todas las tablas necesarias:

```bash
php artisan migrate
```

6. Limpiar cache por seguridad:

```bash
php artisan optimize:clear
```

Con esto la base queda lista.

### B) Restaurar backup existente (opcional)

Si prefieres usar el respaldo incluido:

- `backup_db/crud_app`

1. Crear primero la base vacia:

```sql
CREATE DATABASE crud_app;
```

2. Restaurar el dump desde PowerShell:

```powershell
psql -h 127.0.0.1 -p 5432 -U tu_usuario -d crud_app -f .\backup_db\crud_app
```

3. Configurar `.env` con las mismas credenciales usadas en el restore.

4. Limpiar cache:

```bash
php artisan optimize:clear
```

Importante:

- Si restauras un dump completo que ya contiene estructura y datos, no ejecutes `php artisan migrate` para evitar errores o duplicados.

## 4) Levantar el proyecto

```bash
php artisan serve
```

Abrir en navegador:

- `http://127.0.0.1:8000`

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

Causa: `SESSION_DRIVER=database` y no se han ejecutado migraciones.

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

## Comandos utiles

```bash
php artisan route:list
php artisan test
php artisan migrate:fresh --seed
```

## Notas

- El proyecto usa PostgreSQL por defecto.
- Si vas a levantarlo en otra maquina, no copies `.env`; crea uno nuevo desde `.env.example`.
