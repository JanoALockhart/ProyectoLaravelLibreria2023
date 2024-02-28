## Pasos

- clonar el repo https://github.com/iaw-2023/laravel-template y mantener como owner la organización de la materia.
## parados en el directorio del repositorio recientemente clonado, ejecutar:

- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan serve`

Con el último comando, pueden acceder a http://127.0.0.1:8000/ y ver la cáscara de la aplicación Laravel

### Requisitos

- tener [composer](https://getcomposer.org/) instalado
- tener [php](https://www.php.net/) instalado



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# DOCUMENTACIÓN
## Proyecto Framework PHP - Laravel
### ¿Qué entidades se podrán actualizar?
Las entidades que los administradores de la aplicación podrán actualizar serán:
Autor, 
Libro y
Género

### Que reportes se podrán visualizar o generar?
Los administradores podrán visualizar los pedidos que existen actualmente. Ordenarlos por fecha (de más antiguo a más recientes) o por precio (de mayor valor a menor). 
Fuente de los datos: Entidades Pedidos, Cliente y Libro

### ¿Qué entidades se podrán obtener por API?
Libro   
Autor  
Género

### ¿Qué entidades se podrán modificar por API?
Pedido    

## Proyecto Javascript - React/Vue
### ¿Qué información podrá ver el usuario? 
Información sobre:   
los libros disponibles y su información (autores, género, etc)   
los libros que actualmente tiene en su pedido   

### ¿Qué acciones podría realizar, ya sea la primera vez que ingrese a la aplicación como futuros accesos a la misma?
Buscar libros por título, autores o géneros.   
Ver información sobre un libro y sus autores   
Ver pedido   
Añadir libro al pedido   
Confirmar pedido(Agregar mail, nombre, apellido, dirección)   


## DIAGRAMA ENTIDAD-RELACIÓN
![Diagrama ER](documentacion/DiagramaER.png)  


# Etapa 2: Proyecto Framework PHP - Laravel

## Deployment
Link: https://pixel-pioneers-laravel-git-etapa2-pixel-pioneer.vercel.app/

### Administradores
Usuario: admin@iaw.com | Contraseña: admin123
Usuario: pixelpioneers888@gmail.com | Contraseña: admin123

### API
Swagger UI: https://pixel-pioneers-laravel-git-etapa2-pixel-pioneer.vercel.app/rest/v1/documentation  
Url Base: https://pixel-pioneers-laravel-git-etapa2-pixel-pioneer.vercel.app/rest/v1  

## Librerias Externas Utilizadas

### Boostrap
Versión: 5.2.3  
Link: https://getbootstrap.com/docs/5.2/getting-started/introduction/  

### jQuery
Versión: 3.7.0  
Link: https://jquery.com/  

### Select2
Versión: 4.1.0  
Link: https://select2.org/  

### Datatables
Verisón: 1.13.4  
Link: https://datatables.net/  

#



