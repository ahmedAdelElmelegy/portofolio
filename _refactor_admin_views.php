<?php

$dir = 'D:/php/portfolio/resources/views/admin';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$replacements = [
    // Avoid double prefixing
    'class="bg-slate-950' => 'class="bg-white dark:bg-slate-950',
    ' bg-slate-950 ' => ' bg-white dark:bg-slate-950 ',
    ' bg-slate-950/' => ' bg-white/95 dark:bg-slate-950/',
    ' bg-slate-950"' => ' bg-white dark:bg-slate-950"',
    
    'class="bg-slate-900' => 'class="bg-slate-50 dark:bg-slate-900',
    ' bg-slate-900 ' => ' bg-slate-50 dark:bg-slate-900 ',
    ' bg-slate-900/' => ' bg-slate-50/80 dark:bg-slate-900/',
    ' bg-slate-900"' => ' bg-slate-50 dark:bg-slate-900"',

    ' border-slate-800 ' => ' border-slate-200 dark:border-slate-800 ',
    ' border-slate-800/' => ' border-slate-200/80 dark:border-slate-800/',
    ' border-slate-800"' => ' border-slate-200 dark:border-slate-800"',
    ' border-slate-850 ' => ' border-slate-200 dark:border-slate-800 ',
    ' border-slate-850"' => ' border-slate-200 dark:border-slate-800"',
    ' border-slate-700 ' => ' border-slate-300 dark:border-slate-700 ',
    ' border-slate-700/' => ' border-slate-300/80 dark:border-slate-700/',
    ' border-slate-700"' => ' border-slate-300 dark:border-slate-700"',

    ' text-white ' => ' text-slate-900 dark:text-white ',
    ' text-white"' => ' text-slate-900 dark:text-white"',
    ' text-slate-300 ' => ' text-slate-700 dark:text-slate-300 ',
    ' text-slate-300"' => ' text-slate-700 dark:text-slate-300"',
    ' text-slate-400 ' => ' text-slate-600 dark:text-slate-400 ',
    ' text-slate-400"' => ' text-slate-600 dark:text-slate-400"',
    ' text-slate-200 ' => ' text-slate-800 dark:text-slate-200 ',
    ' text-slate-200"' => ' text-slate-800 dark:text-slate-200"',

    ' hover:bg-slate-900 ' => ' hover:bg-slate-100 dark:hover:bg-slate-900 ',
    ' hover:bg-slate-900"' => ' hover:bg-slate-100 dark:hover:bg-slate-900"',
    ' hover:bg-slate-850 ' => ' hover:bg-slate-100 dark:hover:bg-slate-800 ',
    ' hover:bg-slate-850"' => ' hover:bg-slate-100 dark:hover:bg-slate-800"',
    ' hover:bg-slate-800 ' => ' hover:bg-slate-100 dark:hover:bg-slate-800 ',
    ' hover:bg-slate-800"' => ' hover:bg-slate-100 dark:hover:bg-slate-800"',
    ' hover:text-white ' => ' hover:text-slate-900 dark:hover:text-white ',
    ' hover:text-white"' => ' hover:text-slate-900 dark:hover:text-white"',
];

$modified = 0;
foreach ($files as $file) {
    if (!$file->isFile() || $file->getExtension() !== 'php') continue;
    $path = str_replace('\\', '/', $file->getPathname());
    if (str_ends_with($path, 'dashboard.blade.php') || str_ends_with($path, 'login.blade.php')) continue;

    $content = file_get_contents($path);
    $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);

    // Clean up any double definitions if any
    $newContent = str_replace('dark:dark:', 'dark:', $newContent);
    $newContent = str_replace('text-slate-900 dark:text-slate-900', 'text-slate-900', $newContent);

    if ($content !== $newContent) {
        file_put_contents($path, $newContent);
        echo "Refactored: " . basename($path) . PHP_EOL;
        $modified++;
    }
}

echo "Total admin files refactored: {$modified}" . PHP_EOL;

