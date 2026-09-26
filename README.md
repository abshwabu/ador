# Adorn Trading PLC

> **Design. Source. Deliver.**  
> Global wholesale furnishing, interior finishing, procurement, and project support in Addis Ababa, Ethiopia.

This repository contains the dynamic Laravel + Filament web application and administration portal for **Adorn Trading PLC**. The platform powers the public-facing brand showcase, case studies portfolio, team roster, and an administrative control panel to manage all site copy, products, services, process steps, projects, and gallery assets.

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation & Setup](#installation--setup)
  - [1. Clone Repository](#1-clone-repository)
  - [2. Install Composer Dependencies](#2-install-composer-dependencies)
  - [3. Environment Configuration](#3-environment-configuration)
  - [4. Database Migration & Seeding](#4-database-migration--seeding)
  - [5. Link Public Storage](#5-link-public-storage)
  - [6. Create an Admin User](#6-create-an-admin-user)
- [Production Deployment](#production-deployment)
  - [Deployment Checklist](#deployment-checklist)
  - [Automated Deployment Script](#automated-deployment-script)
  - [Manual Step-by-Step Deployment](#manual-step-by-step-deployment)
  - [Web Server Configuration (Nginx)](#web-server-configuration-nginx)
  - [File Permissions & Security](#file-permissions--security)
  - [Cron & Task Scheduling](#cron--task-scheduling)
- [Public Routes & Views](#public-routes--views)
- [Filament Admin Panel](#filament-admin-panel)
- [Running Automated Tests](#running-automated-tests)
- [License](#license)

---

## Features

- **Public Web Application**:
  - **Homepage (`/`)**: Fully dynamic, responsive showcase featuring Hero, About, Product Portfolio, Interior Solutions, Process Steps, Featured Leadership, Showroom CTA, Gallery Vignettes, and Contact consultation form.
  - **Portfolio (`/portfolio`)**: Case studies index grid with category filters, cover photography, client excerpts, and direct links.
  - **Project Detail (`/portfolio/{project:slug}`)**: Detailed project case studies featuring full client/location/year metadata bar, scope narrative, and dynamic high-resolution image gallery.
  - **Team Roster (`/team`)**: Complete leadership and staff directory with roles, biographies, photos/monogram initial avatars, email, and LinkedIn links.
  - **Shared Master Layout**: Unified navigation with mobile drawer and dynamic footer powered by global brand settings.
- **Filament Admin Panel (`/admin`)**:
  - **Settings Management**: Singleton tabbed control page (Brand, Hero, About, Process, Team, Quote/CTA, Contact, Footer, SEO).
  - **Products Resource**: Manage product cards, categories, labels, and descriptions.
  - **Services Resource**: Manage solutions with Heroicons and descriptions.
  - **Process Steps Resource**: Manage the 5-step workflow.
  - **Gallery Items Resource**: Manage showroom and inspiration gallery images and captions.
  - **Team Members Resource**: Manage team members, bios, roles, social links, and featured status with photo upload.
  - **Projects Resource**: Manage portfolio case studies with inline image repeater for project galleries.

---

## Requirements

- **PHP**: `^8.2` (with `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo` extensions)
- **Composer**: `^2.x`
- **Database**: SQLite (default), MySQL, or PostgreSQL
- **Web Server**: Built-in PHP server, Nginx, or Apache

---

## Installation & Setup

Follow these steps to set up the application locally:

### 1. Clone Repository

```bash
git clone https://github.com/abshwabu/ador.git
cd ador
```

### 2. Install Composer Dependencies

Install all PHP dependencies including Laravel framework, Filament, and required packages:

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file and generate a unique application encryption key:

```bash
cp .env.example .env
php artisan key:generate
```

By default, the `.env` file is configured to use SQLite:

```env
DB_CONNECTION=sqlite
```

If the SQLite database file does not already exist, create it:

```bash
touch database/database.sqlite
```

### 4. Database Migration & Seeding

Run all database schema migrations and populate the database with default rebranded content (Settings, Products, Services, Process Steps, Gallery Items, Team Members, and Portfolio Projects):

```bash
php artisan migrate --seed
```

> **Note**: The default seeder also automatically creates a ready-to-use administrator account:
> - **Email**: `admin@adorn.com`
> - **Password**: `password`

### 5. Link Public Storage

Create the symbolic link from `public/storage` to `storage/app/public` so that uploaded logos, team photos, and project galleries are publicly accessible:

```bash
php artisan storage:link
```

### 6. Create an Admin User

To create an additional or personalized administrator account for the Filament panel, run the interactive Filament command:

```bash
php artisan make:filament-user
```

You will be prompted to provide:
1. **Name**: (e.g., `Abdulhamid Negashe`)
2. **Email address**: (e.g., `admin@adorntrading.com`)
3. **Password**: (e.g., `SecurePassword123`)

Once created, log in at `http://localhost:8000/admin`.

### 7. Start the Development Server

Start the local PHP development server:

```bash
php artisan serve
```

Visit the application in your browser:
- **Public Site**: [http://localhost:8000](http://localhost:8000)
- **Portfolio**: [http://localhost:8000/portfolio](http://localhost:8000/portfolio)
- **Team**: [http://localhost:8000/team](http://localhost:8000/team)
- **Admin Panel**: [http://localhost:8000/admin](http://localhost:8000/admin)

---

## Production Deployment

This application is fully production-ready for deployment on VPS / Cloud (Forge, Ploi, Ubuntu, DigitalOcean) or **Shared Hosting (cPanel, Hostinger, Namecheap, Bluehost)**.

> 💡 **Deploying to Shared Hosting (cPanel / Plesk / DirectAdmin)?**  
> See the dedicated **[Shared Hosting Deployment Guide](file:///home/abshewabu/Documents/projects/laravel/adron/SHARED_HOSTING_GUIDE.md)** for one-click ZIP packaging (`./package-for-shared-hosting.sh`), ready-to-import MySQL dump (`database/adorn_mysql_dump.sql`), and web installer assistant (`cpanel-setup.php`).

### VPS / Cloud Deployment Checklist

- [ ] PHP 8.2+ installed with required extensions (`ext-pdo`, `ext-mbstring`, `ext-tokenizer`, `ext-xml`, `ext-ctype`, `ext-json`, `ext-fileinfo`, `ext-sqlite3` or `ext-pdo_mysql` / `ext-pdo_pgsql`).
- [ ] Composer 2.x installed.
- [ ] Web server (Nginx or Apache) configured to point its document root to the `public/` directory.
- [ ] SSL certificate active (e.g. Let's Encrypt / Certbot).
- [ ] Correct file ownership (`www-data:www-data`) and permissions for `storage/` and `bootstrap/cache/`.
- [ ] `APP_ENV=production` and `APP_DEBUG=false` set in `.env`.
- [ ] `APP_URL` matching your live production domain (e.g. `https://adorntrading.com`).

---

### Automated Deployment Script

An executable deployment script [`deploy.sh`](file:///home/abshewabu/Documents/projects/laravel/adron/deploy.sh) is included at the root of the repository:

```bash
# Standard deployment (pulls git, installs prod dependencies, runs migrations, clears & builds caches):
./deploy.sh

# Initial deployment or re-seeding default content and demo assets:
./deploy.sh --seed
```

What `deploy.sh` does automatically:
1. Puts the site into maintenance mode (`php artisan down`).
2. Pulls the latest commits from the `main` branch.
3. Runs `composer install --no-dev --optimize-autoloader`.
4. Executes database migrations (`php artisan migrate --force`).
5. Ensures public storage symlinks (`php artisan storage:link`).
6. Copies seed assets into public storage if `--seed` flag is passed.
7. Optimizes configuration, route, view, and event caches.
8. Optimizes Filament admin panel assets.
9. Restarts background workers and brings the application live (`php artisan up`).

---

### Manual Step-by-Step Deployment

If you prefer deploying manually or via a CI/CD pipeline (e.g., GitHub Actions, Forge, Ploi):

```bash
# 1. Clone repository to web root
git clone https://github.com/abshwabu/ador.git /var/www/adorn
cd /var/www/adorn

# 2. Configure production environment
cp .env.example .env
nano .env

# Configure key variables:
# APP_NAME="Adorn Trading PLC"
# APP_ENV=production
# APP_DEBUG=false
# APP_URL=https://your-domain.com
# FILESYSTEM_DISK=public

# 3. Install production dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 4. Generate application key
php artisan key:generate

# 5. Database setup (SQLite or MySQL/PostgreSQL)
# If using SQLite:
touch database/database.sqlite
chmod 664 database/database.sqlite

# Run migrations and seed default content:
php artisan migrate --force --seed

# 6. Create symbolic storage link
php artisan storage:link

# 7. Production caching & optimization
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan filament:optimize
```

---

### Web Server Configuration (Nginx)

A production-ready Nginx server block template is provided in [`nginx.conf.example`](file:///home/abshewabu/Documents/projects/laravel/adron/nginx.conf.example).

Key configuration requirements:
- Document root must be `/var/www/adorn/public` (NOT the project root).
- Ensure `client_max_body_size 64M;` is configured to allow high-resolution project portfolio photo uploads via Filament.
- Configure SSL using Certbot:
  ```bash
  sudo certbot --nginx -d your-domain.com -d www.your-domain.com
  ```

---

### File Permissions & Security

Grant proper permissions to the web server user (`www-data` on Ubuntu/Debian):

```bash
sudo chown -R www-data:www-data /var/www/adorn/storage /var/www/adorn/bootstrap/cache /var/www/adorn/database
sudo chmod -R 775 /var/www/adorn/storage /var/www/adorn/bootstrap/cache
```

If using SQLite:
```bash
sudo chmod 664 /var/www/adorn/database/database.sqlite
sudo chmod 775 /var/www/adorn/database
```

---

### Cron & Task Scheduling

To enable Laravel's built-in scheduler, add this single entry to your server's crontab (`crontab -e -u www-data`):

```cron
* * * * * cd /var/www/adorn && php artisan schedule:run >> /dev/null 2>&1
```

---

## Public Routes & Views

| Method | URI | Name | Description |
|---|---|---|---|
| `GET` | `/` | `home` | Public homepage with dynamic database sections |
| `GET` | `/team` | `team.index` | Full leadership and team roster |
| `GET` | `/portfolio` | `portfolio.index` | Portfolio projects grid |
| `GET` | `/portfolio/{project:slug}` | `portfolio.show` | Individual project case study & gallery |
| `GET` | `/admin` | `filament.admin.pages.dashboard` | Filament admin dashboard & authentication |

---

## Filament Admin Panel

The administration portal at `/admin` enables full control over all website content:

- **Settings Page**: Singleton page organized into tabs:
  - **Brand**: Company name, short name, tagline, logo, and favicon.
  - **Hero**: Kicker, 3-line heading, paragraph, button labels & URLs, hero image, badge.
  - **About**: Section heading, body copy, and about image.
  - **Process**: Heading, kicker, and introductory overview.
  - **Team**: Section heading, kicker, and overview.
  - **Quote / CTA**: Showroom banner copy, heading, and action button.
  - **Contact**: Company, address, phone numbers, and official email.
  - **Footer**: Tagline, about paragraph, and copyright statement.
  - **SEO**: Meta title and meta description.
- **Resources**:
  - **Products**: Card numbering, titles, and descriptions.
  - **Services**: Service title, description, and Heroicon identifier.
  - **Process Steps**: Step label (e.g. `STEP 01`), title, and description.
  - **Gallery Items**: Image upload, caption, title, and description.
  - **Team Members**: Name, role, bio, photo upload, email, LinkedIn, and featured toggle.
  - **Projects**: Portfolio case study metadata, slug, cover image, body narrative, and gallery relation manager.
  - **Quote Requests**: Client inquiry inbox displaying quote requests from the homepage consultation form with unread badges, status workflow (New, Contacted, In Progress, Completed, Archived), client details, and internal staff follow-up notes.
- **Dashboard Widgets**:
  - **Inquiry Stats**: Live counters for New Inquiries, In Follow-Up, and Total Inquiries.
  - **Recent Quote Requests**: Interactive table displaying recent homepage inquiries directly on the main admin dashboard for quick response.

---

## Running Automated Tests

The application includes a comprehensive PHPUnit / Pest test suite covering Filament admin authentication, homepage dynamic bindings, team roster filtering, and portfolio case studies.

Run the test suite with:

```bash
php artisan test
```

All 35 tests and 252 assertions run against an isolated in-memory database.

---

## License

This project is proprietary software belonging to **Adorn Trading PLC**. All rights reserved.
