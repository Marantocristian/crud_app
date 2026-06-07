<?php

/**
 * Entry point for Vercel serverless environment.
 * Vercel has a read-only filesystem except for /tmp,
 * so we redirect Laravel's writable directories there.
 */

// ── 1. Crear directorios necesarios en /tmp ──────────────────────────────
$directories = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/testing',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// ── 2. Sobrescribir variables de entorno críticas para Vercel ────────────
$overrides = [
    'APP_ENV'            => 'production',
    'APP_DEBUG'          => 'false',
    'LOG_CHANNEL'        => 'stderr',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'SESSION_DRIVER'     => 'cookie',
    'CACHE_STORE'        => 'array',
    'QUEUE_CONNECTION'   => 'sync',
];

foreach ($overrides as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key]    = $value;
    $_SERVER[$key] = $value;
}

// ── 3. Apuntar el bootstrap/cache a /tmp ────────────────────────────────
// Esto evita errores de escritura al cachear la configuración de Laravel
define('LARAVEL_STORAGE_PATH', '/tmp/storage');

// ── 4. Cargar Laravel ───────────────────────────────────────────────────
require __DIR__ . '/../public/index.php';
