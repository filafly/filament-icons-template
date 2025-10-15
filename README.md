# 🎨 Filament Icons Package Template

This template helps you create custom icon packs for Filament Icons, allowing you to replace default Filament icons with your preferred icon set.

## 🚀 Quick Start

1. **Click 'Use this template' at the top of this page and clone locally**
2. **Run the setup script:**
   ```bash
   php setup.php
   ```
3. **Follow the prompts to configure your package**

The setup script will:
- Configure your package name and namespace
- Set up the correct icon set references
- Update all placeholders with your values
- Replace this README with package documentation
- Delete itself when complete

## 📝 What You'll Need

Before running setup, gather:
- Your vendor name (e.g., 'acme')
- Icon set name in different cases (lowercase, PascalCase)
- The Blade icons package name and version
- Whether your icon set has multiple styles

## 🔧 After Setup

Once configured, you'll need to:
1. Run `composer install`
2. Update icon mappings in your main plugin class
3. Add all available icons to the enum
4. Configure styles if applicable