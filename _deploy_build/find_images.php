<?php
$db = file_get_contents('D:/php/portfolio/database.sql');

echo "=== PROJECT IMAGES IN database.sql ===\n";
if (preg_match_all('/INSERT INTO `project_images`\s*\(([^)]+)\)\s*VALUES\s*(.*?);/s', $db, $matches)) {
    foreach ($matches[2] as $vals) {
        echo $vals . "\n";
    }
} else {
    echo "No INSERT INTO project_images found in database.sql.\n";
}

echo "\n=== PROJECTS (IMAGE/ICON) IN database.sql ===\n";
if (preg_match_all('/INSERT INTO `projects`\s*\(([^)]+)\)\s*VALUES\s*(.*?);/s', $db, $pMatches)) {
    echo "Cols: " . $pMatches[1][0] . "\n";
    foreach ($pMatches[2] as $vals) {
        echo substr($vals, 0, 300) . "...\n";
    }
}

echo "\n=== PHYSICAL FILES ON DISK ===\n";
$dirs = [
    'D:/php/portfolio/storage/app/public',
    'D:/php/portfolio/public/storage',
    'D:/php/portfolio/public/images',
    'D:/php/portfolio/deploy/htdocs/storage',
];
foreach ($dirs as $d) {
    if (is_dir($d)) {
        echo "Dir: $d\n";
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($d, RecursiveDirectoryIterator::SKIP_DOTS));
        foreach ($it as $f) {
            if ($f->isFile()) {
                echo " - " . substr($f->getPathname(), strlen($d) + 1) . "\n";
            }
        }
    } else {
        echo "Dir does not exist: $d\n";
    }
}

