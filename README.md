# Sistema de Búsqueda de Hoteles y Apartamentos

## Descripción

Aplicación Desarrollada para responder a travez de la consola de comandos. Esta Recibe como parametros minimo 3 carateres de busqueda, tiene 2 lenguajes configurados: en, es. Idioma por defecto: es.

## Requisitos Previos

- PHP (7.4 o superior)
- composer
- MySql y Phpmyadmin o cualquier gestor de BBDD para verificar la informacion

## Instalación

1. Copiar el proyecto en la ruta de ejecucion para php

2. Instalar dependencias

```bash
composer install
```

## Configuración

1. Crear archivo `.env` en la raíz del proyecto y coloca las variables de configuración del equipo en uso

```sh
cp .env-example .env
```

2. Desde tu terminal o línea de comandos y accede a MySQL usando el siguiente comando:

```sh
mysql -u tu_usuario -p
```

3. Ejecuta el archivo para la ejecucion de la base de datos dentro de la terminal de MySQL con el siguiente comando:

```sh
SOURCE /ruta/al/proyecto/config/db/schema.sql;
```

4. Por ultimo salimos de la consola de MySQL

```sh
EXIT;
```

## Ejecución

Para ejecutar la aplicación con idioma por defecto (es):

```bash
php ./bin/console bea
```

Para ejecutar la aplicación con idioma ingles (en):

```bash
php ./bin/console bea en
```

## Estructura del Proyecto

```text
project-root/
├── bin/
│   └── console             # Script ejecutable para comandos CLI
├── config/
│   ├── database.php        # Configuración de la base de datos
│   └── services.php        # Configuración de servicios
├── src/
│   ├── Domain/
│   │   ├── Entities/
│   │   │   ├── Accommodation.php
│   │   │   ├── Hotel.php
│   │   │   └── Apartment.php
│   │   └── Interfaces/
│   │       └── AccommodationRepositoryInterface.php
│   ├── Infrastructure/
│   │   ├── Database/
│   │   │   └── MySQLConnection.php
│   │   ├── Factories/
│   │   │   └── AccommodationFactory.php
│   │   └── Repositories/
│   │       └── MySQLAccommodationRepository.php
│   ├── Application/
│   │   ├── Services/
│   │   │   └── AccommodationSearchService.php
│   │   └── Commands/
│   │       └── SearchAccommodationCommand.php
│   └── bootstrap.php       # Archivo de inicialización
├── tests/
│   ├── Unit/
│   │   ├── Domain/
│   │   ├── Infrastructure/
│   │   └── Application/
│   └── Integration/
├── composer.json
├── phpunit.xml
└── README.md
```

## Características Principales

- Búsqueda por palabras clave

## Contribuir

1. Hacer fork del repositorio
2. Crear una nueva rama
3. Realizar cambios y commit
4. Crear pull request

## Licencia

Este proyecto está bajo la Licencia MIT.

## Información de Contacto

- **Nombre:** Jonay Medina
- **Correo:** [jonaymedinadev@gmail.com](mailto:jonaymedinadev@gmail.com)