# Validate-Token-Exam
Examen de Oportunidad de Trabajo

Este repositorio incluye una aplicacion de almacenamiento de tokens por medio de uaurios y validacion de existencia 
El proyecto cuenta comn una infraestructura docker para su facil instalacion 

Formas de Ejecutar el proyecto

# Infraestructura nesesaria
Un computador con el sistema Docker instalado

# 1 Paso - Clonar proyecto
git Clone <repo>

# 2 Paso - Copiar variables
cp .env.example .env

# 3 Paso - Levantar contenedores
docker compose up -d --build

# 4 Paso - Instalar dependencias
docker compose exec app composer install

# 5 Paso - Generar key
docker compose exec app php artisan key:generate

# 6 Paso - Ejecutar migraciones
docker compose exec app php artisan migrate

# Acceder
http://localhost:8000