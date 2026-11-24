<?php
echo "=== Packaging 00-quick-update.zip ===" . PHP_EOL;

$base = 'D:/php/portfolio';
$staging = $base . '/_deploy_build/laravel';

function copyDir($src, $dst) {
    if (!is_dir($dst)) @mkdir($dst, 0777, true);
    foreach (scandir($src) as $item) {
        if ($item === '.' || $item === '..') continue;
        $s = $src . '/' . $item;
        $d = $dst . '/' . $item;
        if (is_dir($s)) copyDir($s, $d);
        else copy($s, $d);
    }
}

// 1. Sync app, resources/views, lang, database/migrations
copyDir($base . '/app', $staging . '/app');
copyDir($base . '/resources/views', $staging . '/resources/views');
copyDir($base . '/lang', $staging . '/lang');
copyDir($base . '/database/migrations', $staging . '/database/migrations');
copyDir($base . '/routes', $staging . '/routes');

echo "Staging files synchronized." . PHP_EOL;

// 2. Build 00-quick-update.zip
$zipPath = $base . '/deploy/00-quick-update.zip';
if (file_exists($zipPath)) @unlink($zipPath);

$zip = new ZipArchive();
if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    die("Cannot create zip at $zipPath\n");
}

$dirsToZip = [
    'app' => $base . '/app',
    'resources/views' => $base . '/resources/views',
    'lang' => $base . '/lang',
    'database/migrations' => $base . '/database/migrations',
    'routes' => $base . '/routes',
];

$fileCount = 0;
foreach ($dirsToZip as $prefix => $sourceDir) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($sourceDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($iterator as $item) {
        if ($item->isFile()) {
            $rel = 'laravel/' . $prefix . '/' . str_replace('\\', '/', substr($item->getPathname(), strlen($sourceDir) + 1));
            $zip->addFile($item->getPathname(), $rel);
            $fileCount++;
        }
    }
}

$zip->close();
echo "SUCCESS: Created 00-quick-update.zip with $fileCount files. Size: " . round(filesize($zipPath)/1024, 1) . " KB" . PHP_EOL;

