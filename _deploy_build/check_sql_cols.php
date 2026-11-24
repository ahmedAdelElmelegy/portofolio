<?php
$dbSql = file_get_contents('D:/php/portfolio/database.sql');
$updateSql = file_get_contents('D:/php/portfolio/deploy/update_arabic_data.sql');

// Extract tables and columns from database.sql
preg_match_all('/CREATE TABLE `?([a-zA-Z0-9_]+)`?\s*\((.*?)\)\s*ENGINE/s', $dbSql, $tableMatches, PREG_SET_ORDER);
$dbSchema = [];
foreach ($tableMatches as $tm) {
    $tbl = $tm[1];
    $lines = explode("\n", $tm[2]);
    $cols = [];
    foreach ($lines as $l) {
        $l = trim($l);
        if (preg_match('/^`([a-zA-Z0-9_]+)`/', $l, $cm)) {
            $cols[] = $cm[1];
        }
    }
    $dbSchema[$tbl] = $cols;
}

// Extract ALTER TABLE columns in update_arabic_data.sql
preg_match_all('/ALTER TABLE `?([a-zA-Z0-9_]+)`?\s+ADD\s+(.*?);/s', $updateSql, $alterMatches, PREG_SET_ORDER);
foreach ($alterMatches as $am) {
    $tbl = $am[1];
    preg_match_all('/ADD `?([a-zA-Z0-9_]+)`?/i', 'ADD ' . $am[2], $addMatches);
    if (!isset($dbSchema[$tbl])) {
        $dbSchema[$tbl] = [];
    }
    foreach ($addMatches[1] as $newCol) {
        if (!in_array($newCol, $dbSchema[$tbl])) {
            $dbSchema[$tbl][] = $newCol;
        }
    }
}

// Check every INSERT INTO in update_arabic_data.sql
preg_match_all('/INSERT INTO `?([a-zA-Z0-9_]+)`?\s*\(([^)]+)\)/', $updateSql, $insertMatches, PREG_SET_ORDER);
$issues = [];
foreach ($insertMatches as $im) {
    $tbl = $im[1];
    $cols = array_map(function($c) { return trim(trim($c), "` \t\n\r"); }, explode(',', $im[2]));
    if (!isset($dbSchema[$tbl])) {
        $issues[] = "Unknown table in INSERT: $tbl";
        continue;
    }
    foreach ($cols as $col) {
        if (!in_array($col, $dbSchema[$tbl])) {
            $issues[] = "Unknown column in $tbl: $col";
        }
    }
}

echo "=== ISSUES FOUND ===\n";
if (empty($issues)) {
    echo "No missing columns! All columns match.\n";
} else {
    foreach ($issues as $iss) {
        echo "- $iss\n";
    }
}

