<?php

$vendorDir = 'D:/php/portfolio/_deploy_build/laravel/vendor';
$vendorZip = 'D:/php/portfolio/deploy/vendor.zip';
if (file_exists($vendorZip)) @unlink($vendorZip);

$vZip = new ZipArchive();
$vZip->open($vendorZip, ZipArchive::CREATE);

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($vendorDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $item) {
    $rel = str_replace('\\', '/', substr($item->getPathname(), strlen($vendorDir) + 1));
    if ($item->isDir()) {
        $vZip->addEmptyDir($rel);
    } else {
        $vZip->addFile($item->getPathname(), $rel);
        $vZip->setCompressionName($rel, ZipArchive::CM_DEFLATE, 9);
    }
}
$vZip->close();
echo "Deflated vendor.zip size: " . round(filesize($vendorZip) / 1024 / 1024, 2) . " MB" . PHP_EOL;

