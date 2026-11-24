<?php
$z = new ZipArchive();
if ($z->open('D:/php/portfolio/deploy/zips/01-laravel-core.zip') === true) {
    echo "01-laravel-core first 10 entries:" . PHP_EOL;
    for ($i = 0; $i < min(10, $z->numFiles); $i++) {
        echo "  " . $z->getNameIndex($i) . PHP_EOL;
    }
    $z->close();
}

if ($z->open('D:/php/portfolio/deploy/zips/02-vendor-part1.zip') === true) {
    echo "02-vendor-part1 first 10 entries:" . PHP_EOL;
    for ($i = 0; $i < min(10, $z->numFiles); $i++) {
        echo "  " . $z->getNameIndex($i) . PHP_EOL;
    }
    $z->close();
}

