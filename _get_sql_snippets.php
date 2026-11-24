<?php

$sql = file_get_contents('D:/php/portfolio/database.sql');

function getSnippet($sql, $table) {
    if (preg_match('/INSERT INTO `' . $table . '`[^;]+;/s', $sql, $m)) {
        return $m[0];
    }
    return '';
}

foreach (['profiles', 'experiences', 'skills', 'projects', 'video_content_items'] as $t) {
    echo "--- $t ---" . PHP_EOL . getSnippet($sql, $t) . PHP_EOL . PHP_EOL;
}

