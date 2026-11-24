<?php
$z = new ZipArchive();
if ($z->open('D:/php/portfolio/deploy/zips/01-laravel-core.zip') === true) {
    echo "--- .env from 01-laravel-core.zip ---" . PHP_EOL;
    echo $z->getFromName('laravel/.env');
    $z->close();
}

