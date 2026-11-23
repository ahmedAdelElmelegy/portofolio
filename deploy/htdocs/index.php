<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Locate Laravel core application
// 1. When extracted inside htdocs: __DIR__ . '/laravel'
// 2. When placed outside htdocs:  __DIR__ . '/../laravel'
// 3. Fallback for standard local: __DIR__ . '/..'
if (file_exists(__DIR__ . '/laravel/vendor/autoload.php') && file_exists(__DIR__ . '/laravel/bootstrap/app.php')) {
    $corePath = __DIR__ . '/laravel';
} elseif (file_exists(__DIR__ . '/../laravel/vendor/autoload.php') && file_exists(__DIR__ . '/../laravel/bootstrap/app.php')) {
    $corePath = __DIR__ . '/../laravel';
} elseif (file_exists(__DIR__ . '/../vendor/autoload.php') && file_exists(__DIR__ . '/../bootstrap/app.php')) {
    $corePath = __DIR__ . '/..';
} elseif (file_exists(__DIR__ . '/vendor/autoload.php') && file_exists(__DIR__ . '/bootstrap/app.php')) {
    $corePath = __DIR__;
} else {
    http_response_code(500);
    die('Could not locate Laravel core files. Please make sure the "laravel" folder is uploaded.');
}

// Maintenance mode
if (file_exists($maintenance = $corePath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register Autoloader
require $corePath . '/vendor/autoload.php';

// Bootstrap Laravel
/** @var Application $app */
$app = require_once $corePath . '/bootstrap/app.php';

// Explicitly bind the public path to current directory (htdocs)
$app->usePublicPath(__DIR__);

// Handle request
$app->handleRequest(Request::capture());
