# API-Gestor de proyectos

Este proyecto esta elaborado con el Framework LARAVEL como base y consiste en la creacion de una API para un gestor de proyectos y tareas.

## 🧰 Requisitos previos

Asegúrate de tener instalado:

- PHP 8.1 o superior
- Composer
- MySQL / MariaDB
- Git

Puedes verificar la version de PHP asi:

``` php -v ```

## 📥 1. Clona el repositorio

``` git clone https://github.com/USUARIO/NOMBRE_REPOSITORIO_API.git ```

## ⚙️ 2. Instala las dependencias

`` composer install ``

## 🧪 3. Configura las variables de entorno

Copia el archivo de entorno y editalo:

`` cp .env.example .env ``

## 🔑 4. Genera la clave de la aplicación

`` php artisan key:generate ``

## 🗄️ 5. Ejecuta las migraciones

Esto creará las tablas necesarias (users, projects, tasks, etc.):

``php artisan migrate``


⚠️ Importante:
Si algo falla aquí, revisa que la base de datos exista y las credenciales sean correctas.

## 🔐 6. Configura Laravel Sanctum

Sanctum ya está integrado, pero verifica:

Middleware correcto (por defecto en Laravel 10+)

**En config/auth.php:**

``` 
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'sanctum' => [
        'driver' => 'sanctum',
        'provider' => 'users',
    ],
],
```

## ▶️ 7. Levanta el servidor

``php artisan serve``


La API quedará disponible en:

http://127.0.0.1:8000

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

##
Y esto es todo, asegurate de seguir todos los pasos para que la API funcione correctamente, puedes explorar el codigo mas a fondo cuando te sientas listo.
