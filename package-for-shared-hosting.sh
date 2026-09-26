#!/usr/bin/env bash
# ==============================================================================
# Adorn Trading PLC - Shared Hosting Zip Packager
# ==============================================================================
# Bundles the entire application, production vendor packages, and seed assets
# into a single ZIP archive ready to upload and extract in cPanel File Manager.
# ==============================================================================

set -e

echo "--------------------------------------------------------"
echo "  📦 Packaging Adorn Trading PLC for Shared Hosting     "
echo "--------------------------------------------------------"

# 1. Ensure production dependencies are installed
echo "⚙️ Preparing production vendor dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# 2. Clear local caches so no stale local paths are archived
echo "🧹 Clearing temporary caches..."
php artisan optimize:clear

# 3. Create zip archive
ZIP_NAME="adorn-shared-hosting.zip"
echo "🗜️ Creating ${ZIP_NAME}..."
rm -f "${ZIP_NAME}"

zip -r "${ZIP_NAME}" . \
    -x ".git/*" \
    -x ".git" \
    -x "node_modules/*" \
    -x "tests/*" \
    -x ".phpunit.result.cache" \
    -x "phpunit.xml" \
    -x "storage/logs/*.log" \
    -x ".env" \
    -x "${ZIP_NAME}"

echo "--------------------------------------------------------"
echo "  ✅ Packaged successfully: ${ZIP_NAME}"
echo "  📤 Upload this file to cPanel File Manager & Extract"
echo "--------------------------------------------------------"
