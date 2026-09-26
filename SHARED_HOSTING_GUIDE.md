# Adorn Trading PLC - Shared Hosting Deployment Guide (cPanel / Plesk / DirectAdmin)

This guide provides step-by-step instructions for deploying this Laravel 11 + Filament 3 application to **shared hosting** (such as **cPanel**, **Hostinger**, **Namecheap**, **Bluehost**, **GoDaddy**, **SiteGround**, **InMotion**, etc.).

---

## Quick Reference Summary

| Requirement | Value |
|---|---|
| **PHP Version** | `8.2` or `8.3` (Set in cPanel MultiPHP Manager or Select PHP Version) |
| **Required Extensions** | `pdo_mysql`, `mbstring`, `fileinfo`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `zip`, `intl` |
| **Web Root** | Point to `public/` folder (or use Method B / C below) |
| **Packager Script** | `./package-for-shared-hosting.sh` (builds `adorn-shared-hosting.zip`) |
| **SQL Database Dump** | `database/adorn_mysql_dump.sql` (ready to import in phpMyAdmin) |
| **Web Setup Assistant** | `https://your-domain.com/cpanel-setup.php?key=adorn2026` |
| **Default Admin Login** | Email: `admin@adorn.com` \| Password: `password` |

---

## Table of Contents

1. [Step 1: Set PHP Version & Extensions in cPanel](#step-1-set-php-version--extensions-in-cpanel)
2. [Step 2: Create MySQL Database in cPanel](#step-2-create-mysql-database-in-cpanel)
3. [Step 3: Package & Upload Application Files](#step-3-package--upload-application-files)
4. [Step 4: Configure the Web Directory (Choose Method A, B, or C)](#step-4-configure-the-web-directory-choose-method-a-b-or-c)
   - [Method A (Recommended): Change Document Root to public](#method-a-recommended-change-document-root-to-public)
   - [Method B: Separate Core Files from public_html](#method-b-separate-core-files-from-public_html)
   - [Method C: Single Folder in public_html using Root .htaccess](#method-c-single-folder-in-public_html-using-root-htaccess)
5. [Step 5: Configure `.env` File](#step-5-configure-env-file)
6. [Step 6: Initialize Database & Public Storage](#step-6-initialize-database--public-storage)
   - [Option 1: Using the Web Assistant (No SSH Required)](#option-1-using-the-web-assistant-no-ssh-required)
   - [Option 2: Using phpMyAdmin (Import SQL)](#option-2-using-phpmyadmin-import-sql)
   - [Option 3: Using cPanel Terminal / SSH](#option-3-using-cpanel-terminal--ssh)
7. [Step 7: Post-Deployment Security & Admin Access](#step-7-post-deployment-security--admin-access)

---

## Step 1: Set PHP Version & Extensions in cPanel

1. Log in to your hosting cPanel.
2. In the search bar, type **Select PHP Version** or **MultiPHP Manager**.
3. Set your domain's PHP version to **PHP 8.2** or **PHP 8.3**.
4. Click on the **Extensions** tab and verify the following are checked:
   - `pdo_mysql`
   - `mbstring`
   - `fileinfo`
   - `openssl`
   - `tokenizer`
   - `xml` / `dom`
   - `ctype`
   - `json`
   - `zip`
   - `intl`
5. In **PHP Options / Options tab**:
   - `upload_max_filesize` = `64M`
   - `post_max_size` = `64M`
   - `memory_limit` = `256M` or `512M`

---

## Step 2: Create MySQL Database in cPanel

1. In cPanel, navigate to **MySQL® Databases**.
2. **Create New Database**:
   - Enter a name, e.g. `adorn_db` &rarr; Click **Create Database**.
   - Note down the full database name (e.g. `cpaneluser_adorn_db`).
3. **Create New User**:
   - Enter a username, e.g. `adorn_user`.
   - Generate a strong password (copy it!).
   - Click **Create User**.
4. **Add User To Database**:
   - Select the user and database you just created.
   - Click **Add**.
   - Check **ALL PRIVILEGES** &rarr; Click **Make Changes**.

---

## Step 3: Package & Upload Application Files

Shared hosting servers often do not have Composer installed. This repository provides an automated packaging script that bundles the pre-installed `vendor/` dependencies and seed assets:

1. On your local machine, run:
   ```bash
   ./package-for-shared-hosting.sh
   ```
   This generates an archive called **`adorn-shared-hosting.zip`**.

2. In cPanel, open **File Manager**.
3. Click the **Settings** icon (top right) &rarr; Check **Show Hidden Files (dotfiles)** &rarr; **Save**.
4. Click **Upload** &rarr; Select `adorn-shared-hosting.zip`.
5. Once the upload reaches 100%, return to File Manager.
6. Right-click `adorn-shared-hosting.zip` &rarr; Click **Extract**.

---

## Step 4: Configure the Web Directory (Choose Method A, B, or C)

### Method A (Recommended): Change Document Root to `public`
*Best for Addon Domains, Subdomains, Hostinger hPanel, or cPanel accounts that allow editing Document Roots.*

1. In cPanel, go to **Domains**.
2. Click **Manage** next to your domain.
3. Change the **Document Root** path from `public_html` to:
   ```
   public_html/public
   ```
   *(or if you extracted the project in `/home/username/adorn`, set document root to `/home/username/adorn/public`)*.
4. Click **Update**. Everything works out-of-the-box without moving any files!

---

### Method B: Separate Core Files from `public_html`
*Standard best practice for primary domains where cPanel locks the web root strictly to `/home/username/public_html`.*

1. In File Manager, create a folder at `/home/username/adorn_core` (outside `public_html`).
2. Move all project files and folders into `adorn_core`, **EXCEPT** the `public/` directory.
3. Move the contents of `public/` into `/home/username/public_html/`.
4. Open `/home/username/public_html/index.php` in File Manager Code Editor:
   - Change line 12:
     ```php
     // Old:
     require __DIR__.'/../vendor/autoload.php';
     // New:
     require __DIR__.'/../adorn_core/vendor/autoload.php';
     ```
   - Change line 19:
     ```php
     // Old:
     $app = require_once __DIR__.'/../bootstrap/app.php';
     // New:
     $app = require_once __DIR__.'/../adorn_core/bootstrap/app.php';
     ```
5. Save `index.php`. The application will automatically detect that `public_html` is the web root!

---

### Method C: Single Folder in `public_html` using Root `.htaccess`
*Quickest method if you unzipped the entire project directly inside `/home/username/public_html`.*

This repository includes a root [`.htaccess`](file:///home/abshewabu/Documents/projects/laravel/adron/.htaccess) file that:
1. Blocks direct web access to `.env`, `composer.json`, `artisan`, `storage/app`, etc.
2. Automatically rewrites all incoming web requests into the `public/` subdirectory.

Simply ensure that `.htaccess` is present at the root of `public_html`.

---

## Step 5: Configure `.env` File

1. In cPanel File Manager, locate `.env.example` in the application directory.
2. Rename or copy `.env.example` to **`.env`**.
3. Edit `.env` and fill in your database details:

```env
APP_NAME="Adorn Trading PLC"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cpaneluser_adorn_db
DB_USERNAME=cpaneluser_adorn_user
DB_PASSWORD=YourSecurePasswordHere

FILESYSTEM_DISK=public
```

4. If you have cPanel Terminal or SSH, generate an app key:
   ```bash
   php artisan key:generate
   ```
   *(Or copy the `APP_KEY` from your local development `.env` into production `.env`)*.

---

## Step 6: Initialize Database & Public Storage

Choose **one** of the three methods below:

### Option 1: Using the Web Assistant (No SSH Required)

1. Open your browser and visit:
   ```
   https://yourdomain.com/cpanel-setup.php?key=adorn2026
   ```
2. The diagnostics table will verify your PHP version, permissions, and database connection.
3. Click **🌱 Run Migrations & Seed Database**.
4. Click **🔗 Link Public Storage**.
5. Click **⚡ Optimize & Cache CPanel**.
6. When complete, click **🗑️ Delete This Setup File (Self-Destruct)** to remove the installer script for security!

---

### Option 2: Using phpMyAdmin (Import SQL)

1. In cPanel, open **phpMyAdmin**.
2. Select your database (`cpaneluser_adorn_db`) on the left sidebar.
3. Click the **Import** tab at the top.
4. Click **Choose File** and select [`database/adorn_mysql_dump.sql`](file:///home/abshewabu/Documents/projects/laravel/adron/database/adorn_mysql_dump.sql).
5. Click **Go** at the bottom.
   *All 11 database tables, system settings, showcase products, portfolio case studies, and the default admin user will be created immediately.*

To link public storage without SSH:
- If you used **Method A** or **Method C**: In cPanel &rarr; **Cron Jobs**, add a one-time cron:
  ```cron
  ln -s /home/username/public_html/storage/app/public /home/username/public_html/public/storage
  ```
- If you used **Method B**:
  ```cron
  ln -s /home/username/adorn_core/storage/app/public /home/username/public_html/storage
  ```

---

### Option 3: Using cPanel Terminal / SSH

If your cPanel hosting has **Terminal** enabled:

```bash
cd /path/to/your/project

# Run migrations and seed data
php artisan migrate --force --seed

# Create storage symlink
php artisan storage:link

# Cache config and routes
php artisan optimize
```

---

## Step 7: Post-Deployment Security & Admin Access

1. **Visit Your Website**:
   Navigate to `https://yourdomain.com`. You should see the homepage with high-resolution photography, hero showcase, and dynamic product catalogs.

2. **Log into Filament Admin Panel**:
   - URL: `https://yourdomain.com/admin`
   - Email: `admin@adorn.com`
   - Password: `password`

3. **Security Checklist**:
   - [ ] Change the admin password immediately in `/admin` &rarr; My Profile or Users.
   - [ ] Ensure `public/cpanel-setup.php` is deleted.
   - [ ] Confirm `APP_DEBUG=false` in `.env`.
   - [ ] Ensure SSL certificate (Let's Encrypt / cPanel AutoSSL) is active.
