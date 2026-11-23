<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Search for the Laravel core application in all possible deployment paths
$possibleCorePaths = [
    __DIR__ . '/../laravel',         // Recommended: /home/volX_X/epiz_xxxxxxx/laravel
    __DIR__ . '/laravel',            // Alternative: /htdocs/laravel
    __DIR__,                         // All-in-one: /htdocs
    dirname(__DIR__) . '/laravel',
];

$corePath = null;
foreach ($possibleCorePaths as $path) {
    if (file_exists($path . '/vendor/autoload.php') && file_exists($path . '/bootstrap/app.php')) {
        $corePath = realpath($path);
        break;
    }
}

if (!$corePath) {
    http_response_code(500);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel Core Not Found — InfinityFree Deployment</title>
        <style>
            body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #0f172a; color: #f8fafc; padding: 40px; line-height: 1.6; }
            .container { max-width: 720px; margin: 0 auto; background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
            h1 { color: #ef4444; margin-top: 0; font-size: 22px; }
            p { color: #cbd5e1; font-size: 14px; }
            pre { background: #0f172a; padding: 14px; border-radius: 8px; color: #38bdf8; overflow-x: auto; font-size: 13px; }
            ul { font-size: 14px; color: #94a3b8; }
            li { margin-bottom: 6px; }
            b { color: #f1f5f9; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Could not locate Laravel core files</h1>
            <p>The web server running in <code><?php echo htmlspecialchars(__DIR__); ?></code> could not find the <b>laravel</b> application core files.</p>
            <p><b>Paths searched:</b></p>
            <pre><?php
            foreach ($possibleCorePaths as $p) {
                $hasAutoload = file_exists($p . '/vendor/autoload.php') ? '[FOUND]' : '[MISSING]';
                $hasBootstrap = file_exists($p . '/bootstrap/app.php') ? '[FOUND]' : '[MISSING]';
                echo htmlspecialchars($p) . "\n  vendor/autoload.php: $hasAutoload\n  bootstrap/app.php:   $hasBootstrap\n\n";
            }
            ?></pre>
            <p><b>How to fix this in InfinityFree:</b></p>
            <ul>
                <li>Make sure you uploaded <b>both</b> folders from <code>deploy.zip</code>: the <code>htdocs</code> folder AND the <code>laravel</code> folder.</li>
                <li>If using FTP (FileZilla): upload <code>htdocs/</code> contents into <code>/htdocs/</code>, and upload <code>laravel/</code> into <code>/</code> (alongside <code>htdocs</code>).</li>
                <li>If using the Online File Manager inside <code>/htdocs</code>: make sure the <code>laravel</code> folder is placed inside <code>/htdocs/laravel/</code>.</li>
            </ul>
        </div>
    </body>
    </html>
    <?php
    exit(1);
}

// Maintenance mode
if (file_exists($maintenance = $corePath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoloader
require $corePath . '/vendor/autoload.php';

// Bootstrap Laravel
/** @var Application $app */
$app = require_once $corePath . '/bootstrap/app.php';

// Set public path to this directory (htdocs) so asset() and storage paths work
$app->usePublicPath(__DIR__);

// Handle request
$app->handleRequest(Request::capture());
