# Validate-Token-Exam
Examen de Oportunidad de Trabajo

Este repositorio incluye una aplicación de almacenamiento de tokens por medio de usuarios y validación de existencia 
El proyecto cuenta con una infraestructura docker para su fácil instalación 

## Formas de Ejecutar el proyecto

### Infraestructura necesaria
Un computador con el sistema Docker instalado

### 1 Paso - Clonar proyecto
Clonamos nuestro Proyecto

    git Clone <repo>

### 3 Paso - Levantar contenedores
En una terminal ubicada en la carpeta donde se encuentre el repositorio clonado ejecutamos 

    docker compose up -d --build

### 4 Paso - Ejecutar migraciones
Al terminar de crear los contenedores ejecutamos las configuraciones básicas de nuestra api con el comando

    docker compose exec app sh docker/scripts/install.sh

## Ejecución Local 
El proyecto puede ejecutarse de manera local 

### 1 Paso - Clonar proyecto
Clonamos nuestro Proyecto

    git Clone <repo>

### 3 Paso - Clonamos él .env
En una terminal ubicada en la carpeta donde se encuentre el repositorio clonado ejecutamos 
    cp .env.example .env

### 4 Paso - Configuramos la Base de datos 
En el archivo .Env configuramos la base de datos colocando nuestras credenciales en los siguientes campos 

    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

### 5 Paso - Ejecutar Configuraciones
Al terminar de configurar la base de datos ejecutamos los sigientes comando en la termnal 

    php artisan key:generate --force
    php artisan jwt:secret --force
    php artisan migrate --force
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear
    chown -R www-data:www-data storage bootstrap/cache


## Acceder
Accedemos al aplicativo con la liga 

    http://localhost   

### Documentacion

En la Carpeta Documentación se encuentra un archivo json con la configuración de Postman de los servicios que se encuentran en el proyecto 

## Monitoreo de las Transacciones

El sistema cuenta con la instalación de telescope como forma de validar las Apis y las transacciones de los servicios este servicio se encuentra cargado por usuario y Password 

__Usuario : Admin__

__Password: Srv123456*__

## Decisiones técnicas relevantes 

Se uso Laravel como framework principal por su estructura clara, soporte para APIs y facilidad para manejar autenticación, migraciones y servicios.

La configuración sensible se maneja mediante variables de entorno en. env.

Se utilizan migraciones para mantener el control de la estructura de la base de datos y escalabilidad en cuanto a control de los datos .

Se separa la lógica del negocio en servicios/controladores para mantener el código más ordenado.

El proyecto puede correr localmente con php artisan serve, pero para ambientes productivos se recomienda usar Nginx + PHP-FPM.
