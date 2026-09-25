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
  - [7. Start the Development Server](#7-start-the-development-server)
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
