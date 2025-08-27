<?php

/**
 * Simple Icon Updater Script
 *
 * This script updates the enum file with all available icons from the blade package.
 * It scans the resources/svg directory and generates enum cases automatically.
 */

// Configuration - Update these values as needed
$config = [
    'vendor_package' => 'afatmustafa/blade-hugeicons', // Change this to your actual package
    'icon_set_name' => 'Hugeicons', // Change this to your icon set name
    'enum_file' => 'src/Enums/Hugeicons.php', // Change this to your enum file path
];

echo "🔍 Icon Updater Script\n";
echo "📦 Package: {$config['vendor_package']}\n";
echo "🎯 Icon Set: {$config['icon_set_name']}\n\n";

// Find SVG files
$svgPath = "vendor/{$config['vendor_package']}/resources/svg";
if (! is_dir($svgPath)) {
    echo "❌ Error: SVG directory not found: {$svgPath}\n";
    echo "Please check that:\n";
    echo "1. The package is installed via composer\n";
    echo "2. The vendor_package path is correct\n";
    echo "3. The package has a resources/svg directory\n";
    exit(1);
}

// Get all SVG files
$svgFiles = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($svgPath, RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'svg') {
        $svgFiles[] = basename($file->getPathname(), '.svg');
    }
}

if (empty($svgFiles)) {
    echo "❌ No SVG files found in {$svgPath}\n";
    exit(1);
}

echo '📁 Found '.count($svgFiles)." SVG files\n";

// Sort alphabetically
sort($svgFiles);

// Generate enum cases
$enumCases = [];
foreach ($svgFiles as $filename) {
    $caseName = filenameToCaseName($filename);
    $enumCases[] = "    case {$caseName} = '{$filename}';";
}

// Create enum content
$enumContent = "<?php

namespace Vendor\\Icons\\{$config['icon_set_name']}\\Enums;

enum {$config['icon_set_name']}: string
{
".implode("\n", $enumCases).'
}
';

// Ensure the directory exists
$enumDir = dirname($config['enum_file']);
if (! is_dir($enumDir)) {
    mkdir($enumDir, 0755, true);
    echo "📁 Created directory: {$enumDir}\n";
}

// Write the enum file
file_put_contents($config['enum_file'], $enumContent);

echo "✅ Successfully updated enum file: {$config['enum_file']}\n";
echo '📝 Generated '.count($enumCases)." icon cases\n";

/**
 * Convert filename to enum case name
 */
function filenameToCaseName(string $filename): string
{
    // Split by hyphens and capitalize each part
    $parts = explode('-', $filename);
    $parts = array_map('ucfirst', $parts);

    return implode('', $parts);
}
