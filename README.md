# EduPass API - To-Do List (Laravel)

Este proyecto es aplicación web desarrollada con **Laravel**, que incluye un módulo para la gestión de **tareas pendientes (To-Do List)**.

## 🚀 Requisitos

- PHP >= 8.1
- Composer
- MySQL o PostgreSQL
- Laravel >= 10

## 🔧 Instalación y ejecución

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

## Licencia
Este proyecto está bajo la licencia MIT.

Desarrollado por ITZALMALTZURA
