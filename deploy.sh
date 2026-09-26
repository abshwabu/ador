#!/usr/bin/env bash
# ==============================================================================
# Adorn Trading PLC - Production Deployment Script
# ==============================================================================
# Usage:
#   ./deploy.sh          Standard deployment (pull, install, migrate, cache)
#   ./deploy.sh --seed   Deployment with database seeding
# ==============================================================================

set -e

echo "--------------------------------------------------------"
echo "  🚀 Starting Adorn Trading PLC Production Deployment  "
echo "--------------------------------------------------------"

# 1. Check if artisan exists
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the project root directory."
    exit 1
fi

# 2. Put application into maintenance mode (optional, graceful)
echo "🔒 Enabling maintenance mode..."
(php artisan down --render="errors::503" --secret="adorn-deploy-bypass" --retry=60 2>/dev/null || true)

# 3. Pull latest changes from git
if [ -d ".git" ]; then
    echo "📥 Pulling latest git changes..."
    git pull origin main
else
    echo "ℹ️ Not a git checkout, skipping git pull."
fi

# 4. Install / Update Composer dependencies
echo "📦 Installing composer dependencies (production mode)..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 5. Run Database Migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 6. Optional Database Seeding
if [ "$1" == "--seed" ]; then
    echo "🌱 Seeding initial database content..."
    php artisan db:seed --force
fi

# 7. Ensure Public Storage Link
echo "🔗 Ensuring storage symlink..."
php artisan storage:link || true

# 8. Clear old caches and build production caches
echo "⚡ Caching config, routes, views, and events..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 9. Optimize Filament Admin assets and icons
echo "🎨 Optimizing Filament Admin Panel..."
(php artisan filament:optimize 2>/dev/null || true)

# 10. Restart queue workers (if supervisor/queues are used)
echo "🔄 Restarting queue workers..."
(php artisan queue:restart 2>/dev/null || true)

# 11. Bring application out of maintenance mode
echo "🔓 Bringing application live..."
php artisan up

echo "--------------------------------------------------------"
echo "  ✅ Deployment completed successfully!                "
echo "--------------------------------------------------------"
