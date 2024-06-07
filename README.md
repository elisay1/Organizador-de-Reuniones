<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Ayuda
# Organizador de Reuniones con FilamentPHP en Laravel 11

Instrucciones detalladas sobre cómo crear un proyecto en Laravel 11 utilizando FilamentPHP para desarrollar un Organizador de Reuniones.

## Paso 1: Instalar Laravel

```bash
composer create-project laravel/laravel .
```
# Nota
- El punto "." indica que ya has creado tu carpeta y solo necesitas instalar Laravel.

## Paso 2: Instalar Livewire
```bash
composer require livewire/livewire
```
## Paso 3: Instalar Filament
```bash
composer require filament/filament
```
## Paso 4: Instalar Paneles de Filament
```bash
php artisan filament:install --panels
```
## Paso 5: Crear Usuario Filament
```bash
php artisan make:filament-user
```
# Nota: 
- Se crea el nombre, correo y contraseña del usuario.
## Paso 6: Crear Modelos
```bash
php artisan make:model Nombre -m
```
-El flag "-m" crea las tablas de migraciones.
## Paso 7: Crear Controladores y Vistas
```bash
php artisan make:filament-resource Nombre --view
```
- El flag --view se usa para que se cree la vista.
## Paso 8: Agregar una Tabla en Migraciones
```bash
php artisan make:migration add_fields_to_nombre_table
```
## Paso 9: Crear Tabla de Usuarios
```bash
php artisan make:filament-resource User --generate
```

## Nota General
- Debes tener habilitada la extensión zip de XAMPP (extension=zip) y intl (extension=intl).

## Redes Sociales

- YouTube: [DevCode_256](https://www.youtube.com/@DevCode_256)
- Instagram: [@eli.sayes](https://www.instagram.com/eli.sayes/)
- GitHub: [elisay1](https://github.com/elisay1)
- TikTok: [@elisaycode](https://www.tiktok.com/@elisaycode)

## Contacto

¡Si estás interesado en colaborar en proyectos o simplemente quieres ponerte en contacto conmigo, no dudes en hacerlo!

- WhatsApp: +51 921-674-886
## Licencia

Este proyecto es de código abierto bajo la [Licencia MIT](https://opensource.org/licenses/MIT).

