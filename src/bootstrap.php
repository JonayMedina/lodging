<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

// Cargar configuración
$config = require __DIR__ . '/../config/database.php';

// Configurar error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

// Configurar timezone
date_default_timezone_set('UTC');

// Registrar manejador de errores personalizado
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

// Devolver la configuración
return $config;