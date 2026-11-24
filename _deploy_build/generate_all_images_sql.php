<?php
$galleryDir = 'D:/php/portfolio/storage/app/public/projects/gallery';
$projectMap = [
    'project1' => 1, // Circle
    'project3' => 2, // Nurse Bot
    'project2' => 3, // Al Huda
    'project4' => 4, // BMI Tracker
];

$images = [];
$id = 1;

foreach ($projectMap as $folder => $projectId) {
    $dir = $galleryDir . '/' . $folder;
    if (is_dir($dir)) {
        $files = scandir($dir);
        // Natural sort
        natsort($files);
        $sortOrder = 1;
        foreach ($files as $f) {
            if ($f === '.' || $f === '..') continue;
            if (pathinfo($f, PATHINFO_EXTENSION) === 'webp' || pathinfo($f, PATHINFO_EXTENSION) === 'png' || pathinfo($f, PATHINFO_EXTENSION) === 'jpg') {
                $relPath = 'projects/gallery/' . $folder . '/' . $f;
                $images[] = [
                    'id' => $id++,
                    'project_id' => $projectId,
                    'image_path' => $relPath,
                    'sort_order' => $sortOrder++,
                ];
            }
        }
    }
}

echo "Total images found: " . count($images) . "\n";

$sql = "INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `sort_order`, `created_at`, `updated_at`) VALUES\n";
$values = [];
foreach ($images as $img) {
    $values[] = "({$img['id']}, {$img['project_id']}, '{$img['image_path']}', {$img['sort_order']}, '2026-11-23 12:16:11', '2026-11-23 12:16:11')";
}
$sql .= implode(",\n", $values) . ";\n";

file_put_contents('D:/php/portfolio/_deploy_build/insert_all_project_images.sql', $sql);
echo "SQL generated successfully in _deploy_build/insert_all_project_images.sql\n";

