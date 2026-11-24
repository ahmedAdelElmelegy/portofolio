<?php

echo "=== Syncing updated views to staging and zip packages ===" . PHP_EOL;

$viewsDir = 'D:/php/portfolio/resources/views';
$stagingViews = 'D:/php/portfolio/_deploy_build/laravel/resources/views';

// Helper to copy directory
function copyAll($src, $dst) {
    if (!is_dir($dst)) @mkdir($dst, 0777, true);
    foreach (scandir($src) as $item) {
        if ($item === '.' || $item === '..') continue;
        $s = $src . '/' . $item;
        $d = $dst . '/' . $item;
        if (is_dir($s)) copyAll($s, $d);
        else copy($s, $d);
    }
}

if (is_dir('D:/php/portfolio/_deploy_build/laravel/resources')) {
    copyAll($viewsDir, $stagingViews);
    echo "Staging views updated." . PHP_EOL;
}

// 1. Update 01-laravel-core.zip
$coreZipPath = 'D:/php/portfolio/deploy/zips/01-laravel-core.zip';
$z = new ZipArchive();
if ($z->open($coreZipPath) === true) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($viewsDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    $count = 0;
    foreach ($iterator as $item) {
        if ($item->isFile()) {
            $rel = 'laravel/resources/views/' . str_replace('\\', '/', substr($item->getPathname(), strlen($viewsDir) + 1));
            $z->addFile($item->getPathname(), $rel);
            $count++;
        }
    }
    $z->close();
    echo "01-laravel-core.zip updated with {$count} view files. Size: " . round(filesize($coreZipPath)/1024, 1) . " KB" . PHP_EOL;
}

// 2. Update deploy/laravel-core.zip
$coreZipPath2 = 'D:/php/portfolio/deploy/laravel-core.zip';
if (file_exists($coreZipPath2)) {
    $z2 = new ZipArchive();
    if ($z2->open($coreZipPath2) === true) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($viewsDir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            if ($item->isFile()) {
                $rel = 'resources/views/' . str_replace('\\', '/', substr($item->getPathname(), strlen($viewsDir) + 1));
                $z2->addFile($item->getPathname(), $rel);
            }
        }
        $z2->close();
        echo "deploy/laravel-core.zip updated." . PHP_EOL;
    }
}

// 3. Update deploy.zip
$deployZipPath = 'D:/php/portfolio/deploy.zip';
if (file_exists($deployZipPath)) {
    $z3 = new ZipArchive();
    if ($z3->open($deployZipPath) === true) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($viewsDir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            if ($item->isFile()) {
                $rel = 'laravel/resources/views/' . str_replace('\\', '/', substr($item->getPathname(), strlen($viewsDir) + 1));
                $z3->addFile($item->getPathname(), $rel);
            }
        }
        $z3->close();
        echo "deploy.zip updated." . PHP_EOL;
    }
}

echo "All packages successfully synced!" . PHP_EOL;

