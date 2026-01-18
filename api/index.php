<?php
// Get the base directory where this file is located
$baseDir = dirname(__DIR__);

// Check different possible paths for Laravel
$possiblePaths = [
    $baseDir . '/kosku/public/index.php',
    dirname(__DIR__) . '/kosku/public/index.php',
    '/var/task/user/kosku/public/index.php',
];

foreach ($possiblePaths as $path) {
    if (file_exists($path)) {
        require $path;
        exit;
    }
}

// If no file found, show error
http_response_code(500);
echo "Laravel bootstrap file not found.\n";
echo "Checked paths:\n";
foreach ($possiblePaths as $path) {
    echo "- $path\n";
}
exit;
