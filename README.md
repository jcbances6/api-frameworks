# Curso: Backend con Laravel

Este repositorio contiene el material y el proyecto de ejemplo para el curso de backend con Laravel. Está pensado para practicar conceptos fundamentales de desarrollo backend con PHP y Laravel: rutas y controladores, modelos y Eloquent, migraciones, seeders, validaciones, autenticación básica y pruebas.

## Objetivo

Proveer un proyecto de referencia y ejercicios prácticos para aprender a construir APIs RESTful con Laravel, enfocando en buenas prácticas, estructura del proyecto y flujo de trabajo típico (instalación, configuración, migraciones y pruebas).

## Requisitos

- PHP >= 8.0
- Composer
- MySQL
- Node.js >= 16 (opcional, para assets con Vite)

## Instalación (rápida)

Clona el repositorio y instala dependencias:

```bash
git clone https://github.com/jcbances6/api-frameworks.git
cd api-frameworks
composer install
cp .env.example .env
php artisan key:generate
```

Configura la base de datos en ` .env ` (por ejemplo, para MySQL):

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_api_example
DB_USERNAME=root
DB_PASSWORD=
```

Luego ejecuta migraciones y seeders:

```bash
php artisan migrate --seed
```

## Ejecutar servidor de desarrollo

```bash
php artisan serve
```

Por defecto el servidor correrá en `http://127.0.0.1:8000`.

## Endpoints principales (ejemplos)

Este proyecto contiene rutas para manejar usuarios, categorías y productos. Ejemplos:

- `GET /api/categories` — listar categorías
- `POST /api/categories` — crear categoría
- `GET /api/products` — listar productos
- `POST /api/products` — crear producto
- `POST /api/register` — registrar usuario
- `POST /api/login` — login (si se implementa autenticación)

Revisa `routes/api.php` para la lista completa de rutas y controladores.

## Modelos principales

- `User` — modelo de ejemplo para autenticación y usuario
- `Category` — categorías de productos
- `Product` — productos con relación a categorías

Los modelos están en `app/Models`.

## Estructura recomendada del proyecto

- `app/Http/Controllers` — controladores HTTP
- `app/Models` — modelos Eloquent
- `database/migrations` — migraciones de esquema
- `database/seeders` — seeders de datos de ejemplo
- `routes` — definición de rutas (`api.php`, `web.php`)
- `tests` — pruebas de integración y unitarias


## Buenas prácticas recomendadas en el curso

- Usar migraciones y seeders para versionar la estructura y los datos de ejemplo.
- Validar peticiones con `FormRequest` (carpeta `app/Http/Requests`).
- Escribir pruebas para rutas y lógica crítica.
- Mantener responsabilidades separadas: controladores delgados, servicios cuando sea necesario.


