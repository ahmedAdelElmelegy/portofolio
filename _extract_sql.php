<?php
$sql = file_get_contents('D:/php/portfolio/database.sql');
$tables = ['profiles', 'experiences', 'skills', 'projects', 'project_features', 'project_technologies'];
$output = "-- ============================================================\n";
$output .= "-- كود التحديث المباشر لقاعدة البيانات على phpMyAdmin\n";
$output .= "-- ============================================================\n\n";
$output .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";

foreach ($tables as $t) {
    if (preg_match('/INSERT INTO `' . $t . '`[^;]+;/s', $sql, $m)) {
        $output .= "-- ------------------------------------------------------------\n";
        $output .= "-- تفريغ وإعادة إدخال بيانات جدول: {$t}\n";
        $output .= "-- ------------------------------------------------------------\n";
        $output .= "TRUNCATE TABLE `{$t}`;\n";
        $output .= $m[0] . "\n\n";
    }
}

$output .= "SET FOREIGN_KEY_CHECKS = 1;\n";

file_put_contents('D:/php/portfolio/deploy/update_data.sql', $output);
echo "SQL script written to D:/php/portfolio/deploy/update_data.sql\n";
echo "Length: " . strlen($output) . " bytes\n";

