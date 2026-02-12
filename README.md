# CRUD App - Aplicación Laravel de Gestión de Clientes

Aplicación web para la gestión CRUD (Crear, Leer, Actualizar, Eliminar) de clientes con renumeración automática de IDs.

## Características principales

- ✅ **Crear** nuevos clientes con información completa
- ✅ **Listar** todos los clientes en una tabla paginada
- ✅ **Ver detalle** de cada cliente individual
- ✅ **Editar** información de clientes existentes
- ✅ **Eliminar** clientes con renumeración automática de IDs
- ✅ Base de datos PostgreSQL
- ✅ Interfaz Blade PHP con estilos CSS

## Campos de cliente

Cada cliente registra la siguiente información:

- Nombre completo
- Correo electrónico (único)
- Teléfono (opcional)
- Dirección (opcional)
- Fecha de creación y actualización

## Requisitos

Antes de clonar y configurar el proyecto, asegúrese de tener instalado:

- **PHP 8.2 o superior** - [descargar](https://www.php.net/downloads)
- **Composer** - [descargar](https://getcomposer.org/download/)
- **PostgreSQL 12 o superior** - [descargar](https://www.postgresql.org/download/)
- **Node.js 18 o superior** (opcional, para compilar assets) - [descargar](https://nodejs.org/)
- **Git** - [descargar](https://git-scm.com/)

### Extensiones de PHP requeridas

- pdo
- pdo_pgsql
- openssl
- mbstring
- tokenizer
- XML
- Ctype
- JSON

Puede verificar las extensiones habilitadas ejecutando:

```bash
php -m
```

## Pasos después de clonar (Configuración en una PC nueva)

A continuación se muestran los pasos mínimos para dejar el proyecto funcionando tras clonar el repositorio.

### 1. Clonar el repositorio y entrar en la carpeta

```bash
git clone <https://github.com/Marantocristian/crud_app.git>
```
### 2. Instalar dependencias de PHP (Composer)

```bash
composer install
```
### 3. Crear el archivo de entorno `.env` a partir del ejemplo

```bash
cp .env.example .env
```
### 4. Generar la clave de aplicación (APP_KEY)

```bash
php artisan key:generate
```
### 5. Ajustar las variables de ambiente en `.env`

Edite el archivo `.env` y configure al menos los siguientes valores:

- `DB_DATABASE` - Nombre de la base de datos
- `DB_USERNAME` - Usuario de PostgreSQL
- `DB_PASSWORD` - Contraseña del usuario

### 6. Iniciar servidor de desarrollo

```bash
php artisan serve --port=8080
```

La aplicación estará disponible en `http://localhost:8080`

## Guía de uso rápida

Una vez que la aplicación esté corriendo en `http://localhost:8080`:

### Listar clientes
- Acceda a la página principal que muestra todos los clientes registrados
- Los clientes se muestran en una tabla paginada

### Crear un nuevo cliente
1. Haga clic en el botón "Crear Cliente"
2. Complete los campos:
   - **Nombre Completo** (requerido)
   - **Correo** (requerido, debe ser único)
   - **Teléfono** (opcional)
   - **Dirección** (opcional)
3. Haga clic en "Guardar"

### Ver detalle de un cliente
- En la tabla de clientes, haga clic en el nombre del cliente
- Se mostrará la información completa

### Editar un cliente
1. En la tabla, haga clic en el botón "Editar" o acceda al detalle y haga clic en "Editar"
2. Modifique los datos deseados
3. Haga clic en "Actualizar"

### Eliminar un cliente
- En la tabla, haga clic en el botón "Eliminar"
- Confirme la acción
- Los IDs de los demás clientes se renumerarán automáticamente

## Notas importantes

- Si usa **PostgreSQL**, asegúrese de crear la base de datos y otorgar los permisos necesarios al usuario antes de ejecutar las migraciones.
- Revise y ajuste los valores en `.env` según su entorno (credenciales, puertos, drivers).
- En caso de encontrar errores de conexión a BD, verifique que PostgreSQL esté corriendo y que las credenciales sean correctas.
- **Renumeración automática de IDs**: Cuando elimina un cliente, los IDs se renumeran automáticamente. Por ejemplo, si tiene clientes con IDs 1, 2, 3, 4, 5 y elimina el cliente 3, los IDs se ajustarán a 1, 2, 3, 4.
- El correo electrónico es único, no puede haber dos clientes con el mismo email.
- Los campos teléfono y dirección son opcionales.

## Estructura del Proyecto

```
crud_app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ClienteController.php    # Controlador CRUD de clientes
│   ├── Models/
│   │   └── ClienteModel.php             # Modelo de cliente
│   ├── Services/
│   │   └── ClienteService.php           # Lógica de negocio
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 2026_02_10_000000_create_clientes_table.php
│   │   └── 2026_02_11_000001_renombrar_campos_clientes_a_espanol.php
│   ├── seeders/
│   └── ...
├── resources/
│   ├── views/
│   │   ├── clientes/
│   │   │   ├── index.blade.php          # Lista de clientes
│   │   │   ├── create.blade.php         # Formulario de creación
│   │   │   ├── edit.blade.php           # Formulario de edición
│   │   │   └── show.blade.php           # Detalle de cliente
│   │   ├── layouts/
│   │   └── ...
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php                          # Rutas del CRUD
│   └── ...
├── .env                                 # Variables de entorno
├── composer.json                        # Dependencias PHP
├── package.json                         # Dependencias Node
└── README.md                            # Este archivo
```

## Rutas disponibles

La aplicación expone las siguientes rutas RESTful:

| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| GET | `/` | - | Redirige a listado de clientes |
| GET | `/clientes` | `ClienteController@index` | Listar todos los clientes |
| GET | `/clientes/crear` | `ClienteController@create` | Mostrar formulario de creación |
| POST | `/clientes` | `ClienteController@store` | Guardar nuevo cliente |
| GET | `/clientes/{cliente}` | `ClienteController@show` | Ver detalle de cliente |
| GET | `/clientes/{cliente}/editar` | `ClienteController@edit` | Mostrar formulario de edición |
| PUT | `/clientes/{cliente}` | `ClienteController@update` | Actualizar cliente |
| DELETE | `/clientes/{cliente}` | `ClienteController@destroy` | Eliminar cliente |

## Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Haga un fork del proyecto
2. Cree una rama para su feature (`git checkout -b feature/AmazingFeature`)
3. Commit sus cambios (`git commit -m 'Agregar AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abra un Pull Request

## Licencia

Este proyecto está bajo la licencia MIT. Consulte el archivo LICENSE para más detalles.
