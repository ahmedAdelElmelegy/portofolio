<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Locate Laravel application core
$possibleCorePaths = [
    __DIR__ . '/laravel',
    dirname(__DIR__) . '/laravel',
    __DIR__ . '/../laravel',
    __DIR__,
];

$corePath = null;
foreach ($possibleCorePaths as $candidate) {
    if (file_exists($candidate . '/vendor/autoload.php') && file_exists($candidate . '/bootstrap/app.php')) {
        $corePath = realpath($candidate) ?: $candidate;
        break;
    }
}

if (!$corePath) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<h1>Deployment Configuration Error</h1>';
    echo '<p>Could not locate Laravel core files (<code>vendor/autoload.php</code> or <code>bootstrap/app.php</code>).</p>';
    echo '<p>Please ensure the <code>laravel/</code> folder is uploaded alongside <code>index.php</code> inside <code>htdocs/</code>.</p>';
    echo '<ul>';
    foreach ($possibleCorePaths as $p) {
        echo '<li>Checked path: ' . htmlspecialchars($p) . '</li>';
    }
    echo '</ul>';
    exit(1);
}

// Maintenance mode
if (file_exists($corePath . '/storage/framework/maintenance.php')) {
    require $corePath . '/storage/framework/maintenance.php';
}

// Register autoloader
require $corePath . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once $corePath . '/bootstrap/app.php';

// Bind public path so asset() and public_path() point to this document root (htdocs)
$app->usePublicPath(__DIR__);

// Run application
$request = Request::capture();
$response = $app->handleRequest($request);
$response->send();