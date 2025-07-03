# EduPass API - To-Do List (Laravel)

Este proyecto es aplicación web desarrollada con **Laravel**, que incluye un módulo para la gestión de **tareas pendientes (To-Do List)**.

## Requisitos

- PHP >= 8.1
- Composer
- MySQL o PostgreSQL
- Laravel >= 10

## Instalación y ejecución

1. **Clonar el repositorio**

git clone https://github.com/ITZALMALTZURA/edupass-api.git
cd edupass-api

2. **Instalar dependencias (opccional)**
composer install

3. **Copiar y configurar archivo de entorno**
cp .env.example .env

Edita el archivo .env para establecer tus credenciales de base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edupass
DB_USERNAME=root
DB_PASSWORD=tu_contraseña

4. **Ejecutar Migraciones**
php artisan migrate

5. **Ejecutar  seeders**
php artisan db:seed

6. **Levantar el servidor local**
php artisan serve
Accede a la app en http://127.0.0.1:8000

## Funcionalidades
Crear, listar y marcar tareas como completadas

Vista web con Bootstrap para gestionar tareas

## Endpoints RESTful
Método	Ruta	Descripción
GET	/tasks	Listar todas las tareas
POST	/tasks	Crear una nueva tarea
PUT	/tasks/{id}	Marcar una tarea como completada

## Frontend
Incluye una vista con Blade + Bootstrap 5 que permite:

Ver tareas en una tabla

Agregar nuevas tareas mediante modal

Marcar tareas como completadas (AJAX)

## API REST
Este proyecto incluye una API REST básica para gestionar tareas (Tasks).

## Rutas API
Debido a que el archivo routes/api.php no estaba presente en el entorno inicial, las rutas de la API fueron definidas en routes/web.php bajo un prefijo personalizado:

Route::prefix('api')->group(function () {
    Route::get('/token', [TaskController::class, 'api_getCsrfToken']);
    Route::get('/tasks', [TaskController::class, 'api_index']);
    Route::post('/new_task', [TaskController::class, 'api_create']);
    Route::put('/tasks/{id}', [TaskController::class, 'api_update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'api_destroy']);
});

## Endpoints disponibles
Método	Ruta	Descripción
GET	/api/tasks	Obtener todas las tareas
POST	/api/new_task	Crear una nueva tarea
PUT	/api/tasks/{id}	Marcar tarea como completada
DELETE	/api/tasks/{id}	Eliminar una tarea
GET	/api/token	Obtener token CSRF


## Token CSRF
Debido a que las rutas se encuentran en web.php, están protegidas por middleware de sesión y CSRF. Para poder enviar solicitudes POST, PUT o DELETE correctamente desde un cliente externo (por ejemplo, Postman o fetch/AJAX), debes incluir el token CSRF.

## Crear una tarea desde Postman
Para hacer una solicitud POST a la ruta /api/new_task con protección CSRF habilitada (ya que se usa web.php), sigue estos pasos en Postman:

## Configuración del POST
Método: POST

URL: http://127.0.0.1:8000/api/new_task

Tipo de cuerpo: x-www-form-urlencoded ó form-data

Campos del cuerpo
title	texto	Título de la tarea
description	texto	Descripción (opcional)
due_date	texto	Fecha en formato YYYY-MM-DD
_token	texto	Token CSRF obtenido desde /api/token

## Ejemplo
title: task
description: tarea api
due_date: 2025/07/21
_token: _token_edupass

## Actualizar y eliminar tareas usando Postman
Dado que las rutas están definidas en web.php y el middleware CSRF está activo, las solicitudes PUT y DELETE no se pueden enviar directamente desde Postman. En su lugar, se deben enviar como POST, incluyendo un campo adicional llamado _method que indica el método HTTP real.

## Actualizar una tarea (marcar como completada)
Método en Postman: POST

URL: http://127.0.0.1:8000/api/tasks/{id} (reemplaza {id} con el ID de la tarea)

Body (form-data o x-www-form-urlencoded):

Clave	Valor
_method	PUT
_token	(token CSRF obtenido desde /api/token)

## Licencia
Este proyecto está bajo la licencia MIT.

Desarrollado por ITZALMALTZURA
