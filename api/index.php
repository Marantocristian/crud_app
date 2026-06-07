<?php

/**
 * Entry point for Vercel serverless environment
 * Since Vercel has a read-only filesystem, we must redirect
 * the storage folders to the /tmp directory.
 */

// Directorios temporales requeridos por Laravel
$tmpDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Sobrescribir variables de entorno para usar /tmp
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');

$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['LOG_CHANNEL'] = 'stderr';

// Iniciar Laravel cargando el index.php público
require __DIR__ . '/../public/index.php';
