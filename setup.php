#!/usr/bin/env php
<?php

echo "\n🎨 Filament Icons Package Setup\n";
echo "================================\n\n";

// Collect user input
$config = [];

// Package details
$config['vendor'] = prompt("Enter your vendor name (e.g., 'acme'): ");
$config['vendor_namespace'] = prompt("Enter your vendor namespace (e.g., 'Acme'): ");
$config['iconset_lower'] = prompt("Enter icon set name in lowercase (e.g., 'phosphor'): ");
$config['iconset_pascal'] = prompt("Enter icon set name in PascalCase (e.g., 'Phosphor'): ");
$config['iconset_display'] = prompt("Enter icon set display name (e.g., 'Phosphor Icons'): ");
$config['blade_package'] = prompt("Enter the Blade icons package name (e.g., 'codeat3/blade-phosphor-icons'): ");
$config['blade_version'] = prompt("Enter the Blade icons package version (e.g., '^2.0'): ", '^1.0');

// Author details
echo "\n📝 Author Information\n";
echo "---------------------\n";
$config['author_name'] = prompt("Enter your name: ");
$config['author_email'] = prompt("Enter your email: ");
$config['homepage'] = prompt("Enter homepage URL (optional, press Enter to skip): ", '');

// Icon prefix
$config['icon_prefix'] = prompt("\nEnter the icon prefix used in Blade components (e.g., 'phosphor', 'carbon'): ", $config['iconset_lower']);

// Style support
$hasStyles = strtolower(prompt("\nDoes this icon set have multiple styles (e.g., regular, bold, light)? (y/n): ", 'n')) === 'y';

echo "\n\n🔧 Configuring package...\n";

// Update composer.json
$composerPath = __DIR__ . '/composer.json';
$composer = file_get_contents($composerPath);
$composer = str_replace('vendor/filament-{iconset}-icons', $config['vendor'] . '/filament-' . $config['iconset_lower'] . '-icons', $composer);
$composer = str_replace('{IconSet}', $config['iconset_display'], $composer);
$composer = str_replace('{blade-icon-package}', $config['blade_package'], $composer);
$composer = str_replace('^x.x', $config['blade_version'], $composer);
$composer = str_replace('Your Name', $config['author_name'], $composer);
$composer = str_replace('email@example.com', $config['author_email'], $composer);
$composer = str_replace('Vendor\\\\Icons\\\\{IconSet}\\\\', $config['vendor_namespace'] . '\\\\Icons\\\\' . $config['iconset_pascal'] . '\\\\', $composer);

if (!empty($config['homepage'])) {
    $composer = str_replace('https://your-website.com', $config['homepage'], $composer);
} else {
    // Remove homepage line if not provided
    $composer = preg_replace('/\s*"homepage":\s*"[^"]*",?\n/', '', $composer);
}

file_put_contents($composerPath, $composer);
echo "✅ Updated composer.json\n";

// Update main plugin class
$pluginPath = __DIR__ . '/src/{IconSet}Icons.php';
$newPluginPath = __DIR__ . '/src/' . $config['iconset_pascal'] . 'Icons.php';

if (file_exists($pluginPath)) {
    $plugin = file_get_contents($pluginPath);
    $plugin = str_replace('Vendor\\Icons\\{IconSet}', $config['vendor_namespace'] . '\\Icons\\' . $config['iconset_pascal'], $plugin);
    $plugin = str_replace('{IconSet}Icons', $config['iconset_pascal'] . 'Icons', $plugin);
    $plugin = str_replace('{IconSet}Style', $config['iconset_pascal'] . 'Style', $plugin);
    $plugin = str_replace('{IconSet}::', $config['iconset_pascal'] . '::', $plugin);
    $plugin = str_replace('vendor-filament-{iconset}-icons', $config['vendor'] . '-filament-' . $config['iconset_lower'] . '-icons', $plugin);
    $plugin = str_replace('{iconset}', $config['icon_prefix'], $plugin);
    
    if (!$hasStyles) {
        // Remove style-related lines
        $plugin = preg_replace('/^use .*Style;.*\n/m', '', $plugin);
        $plugin = preg_replace('/^\s*\/\/ Optional:.*\n\s*protected mixed \$styleEnum.*\n/m', '', $plugin);
    } else {
        // Remove the comment about optional styles
        $plugin = str_replace('// Optional, if styles exist', '', $plugin);
        $plugin = str_replace('// Optional: Only if icon set has multiple styles', '', $plugin);
    }
    
    file_put_contents($newPluginPath, $plugin);
    if ($pluginPath !== $newPluginPath) {
        unlink($pluginPath);
    }
    echo "✅ Updated main plugin class\n";
}

// Update Icon enum
$enumPath = __DIR__ . '/src/Enums/{IconSet}.php';
$newEnumPath = __DIR__ . '/src/Enums/' . $config['iconset_pascal'] . '.php';

if (file_exists($enumPath)) {
    $enum = file_get_contents($enumPath);
    $enum = str_replace('Vendor\\Icons\\{IconSet}', $config['vendor_namespace'] . '\\Icons\\' . $config['iconset_pascal'], $enum);
    $enum = str_replace('{IconSet}', $config['iconset_pascal'], $enum);
    
    if (!$hasStyles) {
        // Remove style-related enum cases
        $enum = preg_replace('/\s*case \w+Bold = .*\n/', '', $enum);
        $enum = str_replace('  // If styles are in enum', '', $enum);
    }
    
    file_put_contents($newEnumPath, $enum);
    if ($enumPath !== $newEnumPath) {
        unlink($enumPath);
    }
    echo "✅ Updated Icon enum\n";
}

// Handle Style enum
$styleEnumPath = __DIR__ . '/src/Enums/{IconSet}Style.php';
$newStyleEnumPath = __DIR__ . '/src/Enums/' . $config['iconset_pascal'] . 'Style.php';

if (file_exists($styleEnumPath)) {
    if ($hasStyles) {
        $styleEnum = file_get_contents($styleEnumPath);
        $styleEnum = str_replace('Vendor\\Icons\\{IconSet}', $config['vendor_namespace'] . '\\Icons\\' . $config['iconset_pascal'], $styleEnum);
        $styleEnum = str_replace('{IconSet}Style', $config['iconset_pascal'] . 'Style', $styleEnum);
        
        file_put_contents($newStyleEnumPath, $styleEnum);
        if ($styleEnumPath !== $newStyleEnumPath) {
            unlink($styleEnumPath);
        }
        echo "✅ Updated Style enum\n";
    } else {
        // Delete style enum if not needed
        unlink($styleEnumPath);
        echo "✅ Removed Style enum (not needed)\n";
    }
}

// Delete TemplateIcons.php if it exists
if (file_exists(__DIR__ . '/TemplateIcons.php')) {
    unlink(__DIR__ . '/TemplateIcons.php');
    echo "✅ Removed TemplateIcons.php\n";
}

echo "\n🎉 Package configured successfully!\n";
echo "\nNext steps:\n";
echo "1. Run 'composer install' to install dependencies\n";
echo "2. Update the icon mappings in src/" . $config['iconset_pascal'] . "Icons.php\n";
echo "3. Add all available icons to src/Enums/" . $config['iconset_pascal'] . ".php\n";
if ($hasStyles) {
    echo "4. Configure the available styles in src/Enums/" . $config['iconset_pascal'] . "Style.php\n";
}

echo "\n⚠️  This setup script will now delete itself...\n";

// Helper function
function prompt($question, $default = '') {
    echo $question;
    $input = trim(fgets(STDIN));
    return $input ?: $default;
}

// Self-delete
unlink(__FILE__);