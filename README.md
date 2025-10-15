# 🎨 Filament Icons Package Template

This template helps you create custom icon packs for Filament Icons, allowing you to replace default Filament icons with your preferred icon set.

## 🚀 Quick Start

1. Click 'Use this template' at the top of this page and clone locally
2. Run the setup script:
   ```bash
   php setup.php
   ```
3. Run `composer install` to download dependencies
4. Run `php generate-icon-cases.php` to build the enum cases
5. Map the icon aliases to cases
   ```php
   // In your class that extends IconSet
   protected array $iconMap = [
        PanelsIconAlias::GLOBAL_SEARCH_FIELD => IconSet::Search,
        PanelsIconAlias::PAGES_DASHBOARD_ACTIONS_FILTER => IconSet::Filter,
        ...
   ]
   ```
6. Configure styles if applicable

## 🛠️ The Setup Script
The setup script will:
- Configure your package name and namespace
- Set up the correct icon set references
- Update all placeholders with your values
- Replace this README with package documentation
- Delete itself when complete

## 📝 To Get What You'll Need
Before running setup, gather:
- Your vendor name (e.g., 'acme')
- Icon set name in different cases (lowercase, PascalCase)
- The Blade icons package name and version
- Whether your icon set has multiple styles
