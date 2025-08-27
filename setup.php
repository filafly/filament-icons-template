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
$config['blade_version'] = prompt("Enter the Blade icons package version (e.g., '^2.0', or press Enter for latest): ", '');

// Icon prefix
$config['icon_prefix'] = prompt("\nEnter the icon prefix used in Blade components (e.g., 'phosphor', 'carbon'): ", $config['iconset_lower']);

// Author details
echo "\n📝 Author Information\n";
echo "---------------------\n";
$config['author_name'] = prompt('Enter your name: ');
$config['author_email'] = prompt('Enter your email: ');
$config['homepage'] = prompt('Enter homepage URL (optional, press Enter to skip): ', '');

// Style support
$hasStyles = strtolower(prompt("\nDoes this icon set have multiple styles (e.g., regular, bold, light)? (y/n): ", 'n')) === 'y';

$styles = [];
if ($hasStyles) {
    echo "\n📎 Style Configuration\n";
    echo "---------------------\n";
    echo "Enter the styles available for this icon set.\n";
    echo "For each style, provide:\n";
    echo "  - Name (e.g., 'regular', 'bold', 'light')\n";
    echo "  - Suffix used in icon names (e.g., '', '-bold', '-light')\n";
    echo "  - Enum case name (e.g., 'Regular', 'Bold', 'Light')\n\n";

    // Always add default/regular style first
    echo "Default style (usually 'regular' with no suffix):\n";
    $defaultStyle = [];
    $defaultStyle['name'] = prompt("  Style name (e.g., 'regular'): ", 'regular');
    $defaultStyle['suffix'] = prompt('  Icon suffix (press Enter for none): ', '');
    $defaultStyle['enum'] = prompt("  Enum case (e.g., 'Regular'): ", 'Regular');
    $styles[] = $defaultStyle;

    // Add additional styles
    while (true) {
        $addMore = strtolower(prompt("\nAdd another style? (y/n): ", 'n')) === 'y';
        if (! $addMore) {
            break;
        }

        $style = [];
        $style['name'] = prompt('  Style name: ');
        $style['suffix'] = prompt("  Icon suffix (e.g., '-bold'): ");
        $style['enum'] = prompt('  Enum case: ');
        $styles[] = $style;
    }
}

echo "\n\n🔧 Configuring package...\n";

// Update composer.json
$composerPath = __DIR__.'/composer.json';
$composer = file_get_contents($composerPath);
$composer = str_replace('vendor/filament-{iconset}-icons', $config['vendor'].'/filament-'.$config['iconset_lower'].'-icons', $composer);
$composer = str_replace('{IconSet}', $config['iconset_display'], $composer);
// Handle blade package version
if (! empty($config['blade_version'])) {
    $bladePackageRequire = '"'.$config['blade_package'].'": "'.$config['blade_version'].'"';
} else {
    $bladePackageRequire = '"'.$config['blade_package'].'": "*"';
}
$composer = str_replace('"{blade-icon-package}": "^x.x"', $bladePackageRequire, $composer);
$composer = str_replace('Your Name', $config['author_name'], $composer);
$composer = str_replace('email@example.com', $config['author_email'], $composer);
$composer = str_replace('Vendor\\\\Icons\\\\{IconSet}\\\\', $config['vendor_namespace'].'\\\\Icons\\\\'.$config['iconset_pascal'].'\\\\', $composer);

if (! empty($config['homepage'])) {
    $composer = str_replace('https://your-website.com', $config['homepage'], $composer);
} else {
    // Remove homepage line if not provided
    $composer = preg_replace('/\s*"homepage":\s*"[^"]*",?\n/', '', $composer);
}

file_put_contents($composerPath, $composer);
echo "✅ Updated composer.json\n";

// Update main plugin class
$pluginPath = __DIR__.'/src/{IconSet}Icons.php';
$newPluginPath = __DIR__.'/src/'.$config['iconset_pascal'].'Icons.php';

if (file_exists($pluginPath)) {
    $plugin = file_get_contents($pluginPath);
    $plugin = str_replace('Vendor\\Icons\\{IconSet}', $config['vendor_namespace'].'\\Icons\\'.$config['iconset_pascal'], $plugin);
    // Fix the enum import that has {IconSet} placeholder
    $plugin = str_replace('\\Enums\\{IconSet}', '\\Enums\\'.$config['iconset_pascal'], $plugin);
    $plugin = str_replace('{IconSet}Icons', $config['iconset_pascal'].'Icons', $plugin);
    $plugin = str_replace('{IconSet}Style', $config['iconset_pascal'].'Style', $plugin);
    $plugin = str_replace('{IconSet}::', $config['iconset_pascal'].'::', $plugin);
    $plugin = str_replace('{IconSet}', $config['iconset_pascal'], $plugin); // Catch any remaining {IconSet} placeholders
    $plugin = str_replace('vendor-filament-{iconset}-icons', $config['vendor'].'-filament-'.$config['iconset_lower'].'-icons', $plugin);
    $plugin = str_replace('{iconset}', $config['icon_prefix'], $plugin);

    if (! $hasStyles) {
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
$enumPath = __DIR__.'/src/Enums/{IconSet}.php';
$newEnumPath = __DIR__.'/src/Enums/'.$config['iconset_pascal'].'.php';

if (file_exists($enumPath)) {
    $enum = file_get_contents($enumPath);
    $enum = str_replace('Vendor\\Icons\\{IconSet}', $config['vendor_namespace'].'\\Icons\\'.$config['iconset_pascal'], $enum);
    $enum = str_replace('{IconSet}', $config['iconset_pascal'], $enum);

    if (! $hasStyles) {
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
$styleEnumPath = __DIR__.'/src/Enums/{IconSet}Style.php';
$newStyleEnumPath = __DIR__.'/src/Enums/'.$config['iconset_pascal'].'Style.php';

if (file_exists($styleEnumPath)) {
    if ($hasStyles) {
        // Generate style enum content
        $styleEnumContent = "<?php\n\n";
        $styleEnumContent .= 'namespace '.$config['vendor_namespace'].'\\Icons\\'.$config['iconset_pascal']."\\Enums;\n\n";
        $styleEnumContent .= "use Filafly\\Icons\\Contracts\\StyleEnum;\n\n";
        $styleEnumContent .= 'enum '.$config['iconset_pascal']."Style: string implements StyleEnum\n";
        $styleEnumContent .= "{\n";

        // Add enum cases
        foreach ($styles as $style) {
            $styleEnumContent .= '    case '.$style['enum']." = '".$style['suffix']."';\n";
        }

        $styleEnumContent .= "\n    public function getStyleName(): string\n";
        $styleEnumContent .= "    {\n";
        $styleEnumContent .= "        return match (\$this) {\n";
        foreach ($styles as $style) {
            $styleEnumContent .= '            self::'.$style['enum']." => '".$style['name']."',\n";
        }
        $styleEnumContent .= "        };\n";
        $styleEnumContent .= "    }\n\n";

        $styleEnumContent .= "    public function getEnumSuffix(): string\n";
        $styleEnumContent .= "    {\n";
        $styleEnumContent .= "        return match (\$this) {\n";
        foreach ($styles as $style) {
            $styleEnumContent .= '            self::'.$style['enum']." => '".$style['enum']."',\n";
        }
        $styleEnumContent .= "        };\n";
        $styleEnumContent .= "    }\n\n";

        $styleEnumContent .= "    public static function getStyleNames(): array\n";
        $styleEnumContent .= "    {\n";
        $styleEnumContent .= '        return [';
        $styleNames = array_map(function ($s) {
            return "'".$s['name']."'";
        }, $styles);
        $styleEnumContent .= implode(', ', $styleNames);
        $styleEnumContent .= "];\n";
        $styleEnumContent .= "    }\n\n";

        $styleEnumContent .= "    public static function fromStyleName(string \$styleName): ?self\n";
        $styleEnumContent .= "    {\n";
        $styleEnumContent .= "        return match (strtolower(\$styleName)) {\n";
        foreach ($styles as $style) {
            $styleEnumContent .= "            '".$style['name']."' => self::".$style['enum'].",\n";
        }
        $styleEnumContent .= "            default => null,\n";
        $styleEnumContent .= "        };\n";
        $styleEnumContent .= "    }\n";
        $styleEnumContent .= '}';

        file_put_contents($newStyleEnumPath, $styleEnumContent);
        if ($styleEnumPath !== $newStyleEnumPath && file_exists($styleEnumPath)) {
            unlink($styleEnumPath);
        }
        echo '✅ Generated Style enum with '.count($styles)." styles\n";
    } else {
        // Delete style enum if not needed
        unlink($styleEnumPath);
        echo "✅ Removed Style enum (not needed)\n";
    }
}

// Update README.md from stub
$readmeStubPath = __DIR__.'/README.stub';
$readmePath = __DIR__.'/README.md';
if (file_exists($readmeStubPath)) {
    $readme = file_get_contents($readmeStubPath);

    // Replace placeholders
    $readme = str_replace('{vendor}', $config['vendor'], $readme);
    $readme = str_replace('{iconset}', $config['iconset_lower'], $readme);
    $readme = str_replace('{iconset}', $config['icon_prefix'], $readme);
    $readme = str_replace('{IconSet}', $config['iconset_display'], $readme);
    $readme = str_replace('{IconSetPascal}', $config['iconset_pascal'], $readme);
    $readme = str_replace('{Vendor}', $config['vendor_namespace'], $readme);
    $readme = str_replace('{VendorNamespace}', $config['vendor_namespace'], $readme);
    $readme = str_replace('{blade-package-name}', $config['blade_package'], $readme);
    $readme = str_replace('{author_name}', $config['author_name'], $readme);
    $readme = str_replace('{homepage}', $config['homepage'] ?: 'https://github.com/'.$config['vendor'], $readme);

    // Handle style-related sections
    if (! $hasStyles) {
        // Remove style-related commented sections
        $readme = preg_replace('/<!-- If your icon set has multiple styles.*?-->\n/s', '', $readme);
        $readme = preg_replace('/<!-- If your icon set supports style overrides.*?-->\n/s', '', $readme);
        $readme = preg_replace('/<!-- If your icon set has styles, add this section -->.*?-->\n/s', '', $readme);
    } else {
        // Build style list for README
        $styleList = '';
        $styleMethodList = '';
        foreach ($styles as $style) {
            $styleList .= '- '.ucfirst($style['name']);
            if ($style === $styles[0]) {
                $styleList .= ' (default)';
            }
            $styleList .= "\n";

            // Add method example
            $methodName = strtolower($style['name']);
            $styleMethodList .= $config['iconset_pascal'].'Icons::make()->'.$methodName."();\n";
        }

        // Replace style placeholders
        $readme = str_replace('[Add other styles]', trim($styleList), $readme);
        $readme = str_replace('// ... other style methods', trim($styleMethodList), $readme);

        // Uncomment style sections
        $readme = preg_replace('/<!-- If your icon set has multiple styles.*?\n(.*?)-->/s', '$1', $readme);
        $readme = preg_replace('/<!-- If your icon set supports style overrides.*?\n(.*?)-->/s', '$1', $readme);
        $readme = preg_replace('/<!-- If your icon set has styles, add this section -->\n<!--\n(.*?)\n-->/s', '$1', $readme);
        $readme = preg_replace('/<!--\n(.*?)\n-->/s', '$1', $readme);

        // Build style examples for blade usage
        $bladeExamples = '';
        foreach ($styles as $style) {
            if (! empty($style['suffix'])) {
                $bladeExamples .= "@svg('{iconset}-example".$style['suffix']."')  // ".ucfirst($style['name'])." style\n";
            }
        }
        if (! empty($bladeExamples)) {
            $readme = str_replace("@svg('{iconset}-house-bold')\n@svg('{iconset}-heart-light')\n@svg('{iconset}-settings-regular')", trim($bladeExamples), $readme);
        }
    }

    file_put_contents($readmePath, $readme);
    echo "✅ Generated README.md from stub\n";

    // Delete the stub file
    unlink($readmeStubPath);
    echo "✅ Removed README.stub\n";
}

// Update generate-icon-cases.php with correct configuration
$generateIconCasesPath = __DIR__.'/generate-icon-cases.php';
if (file_exists($generateIconCasesPath)) {
    $generateIconCasesContent = file_get_contents($generateIconCasesPath);

    // Replace configuration placeholders
    $generateIconCasesContent = str_replace(
        "'afatmustafa/blade-hugeicons'",
        "'{$config['blade_package']}'",
        $generateIconCasesContent
    );
    $generateIconCasesContent = str_replace(
        "'Hugeicons'",
        "'{$config['iconset_pascal']}'",
        $generateIconCasesContent
    );
    $generateIconCasesContent = str_replace(
        "'src/Enums/Hugeicons.php'",
        "'src/Enums/{$config['iconset_pascal']}.php'",
        $generateIconCasesContent
    );

    file_put_contents($generateIconCasesPath, $generateIconCasesContent);
    echo "✅ Configured generate-icon-cases.php\n";
}

// Delete TemplateIcons.php if it exists
if (file_exists(__DIR__.'/TemplateIcons.php')) {
    unlink(__DIR__.'/TemplateIcons.php');
    echo "✅ Removed TemplateIcons.php\n";
}

echo "\n🎉 Package configured successfully!\n";
echo "\nNext steps:\n";
echo "1. Run 'composer install' to install dependencies\n";
echo '2. Run "php generate-icon-cases.php" to automatically generate all icon cases in src/Enums/'.$config['iconset_pascal'].".php\n";
echo '3. Update the icon mappings in src/'.$config['iconset_pascal']."Icons.php\n";
if ($hasStyles) {
    echo '4. Configure the available styles in src/Enums/'.$config['iconset_pascal']."Style.php\n";
}

echo "\n⚠️  This setup script will now delete itself...\n";

// Helper function
function prompt($question, $default = '')
{
    echo $question;
    $input = trim(fgets(STDIN));

    return $input ?: $default;
}

// Self-delete
unlink(__FILE__);
