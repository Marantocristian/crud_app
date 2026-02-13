🚀 CRUD APP
Laravel 12 + PostgreSQL

Aplicación web CRUD para gestión de clientes desarrollada con Laravel y PostgreSQL.

🧰 Stack Tecnológico

⚙️ PHP 8.2+

🧱 Laravel 12

🐘 PostgreSQL 12+

🟢 Node.js 18+ (recomendado 20 LTS)

⚡ Vite

📋 Requisitos Previos

Instalar en la máquina destino:

Git

PHP 8.2 o superior

Composer

PostgreSQL

Node.js y npm

Verificar instalación:

php -v
composer -V
psql --version
node -v
npm -v

📦 1) Clonar el Repositorio
git clone https://github.com/Marantocristian/crud_app.git
cd crud_app

📥 2) Instalar Dependencias
composer install

🗄 3) Configuración de Base de Datos (PostgreSQL)

El proyecto ofrece dos formas de configurar la base de datos:

🅰 Opción A — Instalación desde Cero (Recomendada)
1️⃣ Crear la base de datos

Ingresar a PostgreSQL y ejecutar:

CREATE DATABASE crud_app;

2️⃣ Crear archivo .env

Linux/macOS:

cp .env.example .env


Windows (PowerShell):

copy .env.example .env

3️⃣ Configurar credenciales en .env
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

4️⃣ Generar clave de aplicación
php artisan key:generate

5️⃣ Ejecutar migraciones
php artisan migrate


Esto creará automáticamente todas las tablas necesarias.

6️⃣ Limpiar cache
php artisan optimize:clear


✅ Base de datos lista para usar.

🅱 Opción B — Restaurar Backup Existente

El proyecto incluye un respaldo en:

backup_db/crud_app

1️⃣ Crear base vacía
CREATE DATABASE crud_app;

2️⃣ Restaurar el dump

PowerShell:

psql -h 127.0.0.1 -p 5432 -U tu_usuario -d crud_app -f .\backup_db\crud_app

3️⃣ Configurar .env con las mismas credenciales usadas en el restore
4️⃣ Limpiar cache
php artisan optimize:clear


⚠️ Importante:
Si restauras un dump completo (estructura + datos), NO ejecutes php artisan migrate, para evitar conflictos o duplicados.

▶️ 4) Levantar el Proyecto
php artisan serve


Abrir en navegador:

http://127.0.0.1:8000

🌐 Rutas Principales
Método	Ruta	Descripción
GET	/	Redirige a clientes
GET	/clientes	Listado
GET	/clientes/crear	Formulario crear
POST	/clientes	Guardar
GET	/clientes/{cliente}	Detalle
GET	/clientes/{cliente}/editar	Formulario editar
PUT	/clientes/{cliente}	Actualizar
DELETE	/clientes/{cliente}	Eliminar
⚠️ Errores Comunes y Solución
❌ Undefined table "sessions"

Causa:
SESSION_DRIVER=database y no se han ejecutado migraciones.

Solución:

php artisan migrate
php artisan optimize:clear

❌ Error de conexión a PostgreSQL

Verificar:

Servicio PostgreSQL encendido

Credenciales correctas en .env

Base de datos creada (crud_app)

Puerto correcto (5432)

❌ Cambios en .env no se reflejan
php artisan optimize:clear

🛠 Comandos Útiles
php artisan route:list
php artisan test
php artisan migrate:fresh --seed

📂 Estructura Base
app/
 ├── Http/Controllers/ClienteController.php
 ├── Models/ClienteModel.php
resources/views/clientes/
routes/web.php
database/migrations/
backup_db/crud_app

📌 Notas

El proyecto utiliza PostgreSQL por defecto.

No subir el archivo .env al repositorio.

Para usar en otra máquina, crear un nuevo .env desde .env.example.