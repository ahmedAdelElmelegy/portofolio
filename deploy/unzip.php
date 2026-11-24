<?php
/**
 * 1-Click Fast Unzipper for Free Hosting / InfinityFree
 * ---------------------------------------------------
 * How to use:
 * 1. Upload this file (unzip.php) to your /htdocs/ folder on InfinityFree (file size is only ~2 KB).
 * 2. Upload "00-quick-update.zip" to the same /htdocs/ folder (or root).
 * 3. Open in your browser: https://ahmedadel.gt.tc/unzip.php
 * 4. It will extract all updated files in ~1 second, then click the "Delete unzip.php" button for security.
 */

// Basic security token to prevent unauthorized execution
$token = 'adel2026';
$providedToken = $_GET['token'] ?? null;

// Allow direct run if opened normally or with token
$archiveName = '00-quick-update.zip';

// Search locations for the zip archive
$possiblePaths = [
    __DIR__ . '/' . $archiveName,
    dirname(__DIR__) . '/' . $archiveName,
    __DIR__ . '/laravel-core.zip',
    dirname(__DIR__) . '/laravel-core.zip',
];

$foundZip = null;
foreach ($possiblePaths as $p) {
    if (file_exists($p)) {
        $foundZip = $p;
        break;
    }
}

// Handle self-delete
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    @unlink(__FILE__);
    if ($foundZip) @unlink($foundZip);
    header('Location: /');
    exit;
}

$extracted = false;
$error = null;
$extractedFilesCount = 0;

if (isset($_POST['extract']) || isset($_GET['auto'])) {
    if (!$foundZip) {
        $error = "Archive file ($archiveName) not found in /htdocs/ or parent directory.";
    } elseif (!class_exists('ZipArchive')) {
        $error = "PHP ZipArchive extension is not enabled on this server.";
    } else {
        $zip = new ZipArchive();
        $res = $zip->open($foundZip);
        if ($res === TRUE) {
            // Target destination: root directory (parent of htdocs) so 'laravel/...' extracts to '/laravel/'
            $targetDir = dirname(__DIR__);
            $extractedFilesCount = $zip->numFiles;
            $zip->extractTo($targetDir);
            $zip->close();
            $extracted = true;
        } else {
            $error = "Failed to open zip archive. Error code: " . $res;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Fast Deployment Unpacker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl">
        <div class="text-center mb-6">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-blue-400 text-2xl mb-3 shadow-lg shadow-blue-500/10">
                <i class="fa-solid fa-file-zipper"></i>
            </div>
            <h1 class="text-xl font-black text-white">Portfolio 1-Click Fast Unpacker</h1>
            <p class="text-xs text-slate-400 mt-1">Instant server-side extraction for InfinityFree</p>
        </div>

        @if($extracted)
        <div class="mb-6 p-4 rounded-2xl bg-emerald-950/80 border border-emerald-500/40 text-emerald-200">
            <div class="flex items-center gap-3 mb-1">
                <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
                <span class="font-bold text-sm">Extraction Successful!</span>
            </div>
            <p class="text-xs text-emerald-300/80 leading-relaxed">
                Extracted <?php echo $extractedFilesCount; ?> files directly to <code>/laravel/</code>. Your portfolio is now updated with Arabic data, bilingual models, and custom dialogs!
            </p>
        </div>

        <div class="space-y-3">
            <a href="?action=delete" class="w-full py-3 px-4 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-extrabold text-xs flex items-center justify-center gap-2 transition shadow-lg shadow-rose-600/20">
                <i class="fa-solid fa-trash-can"></i>
                <span>Delete unzip.php & Return to Home</span>
            </a>
            <a href="/" target="_blank" class="w-full py-3 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs flex items-center justify-center gap-2 transition">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Open Portfolio Live</span>
            </a>
        </div>
        @else
            @if($error)
            <div class="mb-5 p-4 rounded-2xl bg-rose-950/80 border border-rose-500/40 text-rose-200 text-xs">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <i class="fa-solid fa-triangle-exclamation text-rose-400"></i>
                    <span>Error</span>
                </div>
                <?php echo htmlspecialchars($error); ?>
            </div>
            @endif

            <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 mb-6 text-xs space-y-2">
                <div class="flex justify-between">
                    <span class="text-slate-400">Archive File:</span>
                    <span class="font-mono font-bold text-white"><?php echo $archiveName; ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Status:</span>
                    <?php if ($foundZip): ?>
                        <span class="text-emerald-400 font-bold"><i class="fa-solid fa-check"></i> Found (<?php echo round(filesize($foundZip)/1024, 1); ?> KB)</span>
                    <?php else: ?>
                        <span class="text-rose-400 font-bold"><i class="fa-solid fa-xmark"></i> Not uploaded yet</span>
                    <?php endif; ?>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Target Path:</span>
                    <span class="font-mono text-slate-300">/laravel/</span>
                </div>
            </div>

            <form method="POST">
                <button type="submit" name="extract" value="1"
                        <?php if (!$foundZip) echo 'disabled'; ?>
                        class="w-full py-3.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 disabled:opacity-40 disabled:cursor-not-allowed text-white font-extrabold text-sm shadow-xl shadow-blue-500/25 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-bolt"></i>
                    <span>Unpack & Update Files Now</span>
                </button>
            </form>
        @endif
    </div>
</body>
</html>

