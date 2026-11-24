<?php

$staging = 'D:/php/portfolio/_deploy_build';
$coreZip = 'D:/php/portfolio/deploy/zips/01-laravel-core.zip';

$z = new ZipArchive();
if ($z->open($coreZip) === true) {
    // Overwrite laravel/.env inside the zip with the configured .env
    $z->addFile($staging . '/laravel/.env', 'laravel/.env');
    $z->addFile($staging . '/laravel/config/filesystems.php', 'laravel/config/filesystems.php');
    $z->addFile($staging . '/laravel/app/Providers/AppServiceProvider.php', 'laravel/app/Providers/AppServiceProvider.php');
    $z->addFile($staging . '/laravel/bootstrap/app.php', 'laravel/bootstrap/app.php');
    $z->close();
    echo "Updated 01-laravel-core.zip with live credentials and latest fixes!" . PHP_EOL;
} else {
    echo "Could not open 01-laravel-core.zip" . PHP_EOL;
}

// Verify it
$v = new ZipArchive();
if ($v->open($coreZip) === true) {
    echo "=== Verified laravel/.env in 01-laravel-core.zip ===" . PHP_EOL;
    echo $v->getFromName('laravel/.env') . PHP_EOL;
    $v->close();
}

