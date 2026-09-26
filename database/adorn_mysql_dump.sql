-- =====================================================================
-- Adorn Trading PLC - Complete MySQL Database Dump
-- Generated for Shared Hosting (cPanel / phpMyAdmin / Plesk)
-- Compatible with MySQL 5.7+, MySQL 8.0+, MariaDB 10.3+
-- =====================================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@adorn.com', NULL, '$2y$12$oN2yJK.8t2pcMeJ9ukBBuu3h4fv6mOdkIfhgp2nrQV20tck6915vG', NULL, '2026-09-26 05:52:20', '2026-09-26 05:52:20');

-- Table structure for `password_reset_tokens`
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `sessions`
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `cache`
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `cache_locks`
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `jobs`
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `job_batches`
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `failed_jobs`
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `migrations`
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_24_080029_create_settings_table', 1),
(5, '2026_09_24_080918_create_products_table', 1),
(6, '2026_09_24_080919_create_services_table', 1),
(7, '2026_09_24_080920_create_process_steps_table', 1),
(8, '2026_09_24_080921_create_gallery_items_table', 1),
(9, '2026_09_24_081525_create_team_members_table', 1),
(10, '2026_09_24_081917_create_projects_table', 1),
(11, '2026_09_24_081918_create_project_images_table', 1);

-- Table structure for `settings`
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL DEFAULT 'Adorn Trading PLC',
  `company_short_name` varchar(255) NOT NULL DEFAULT 'Adorn',
  `brand_tagline` text DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  `hero_kicker` varchar(255) DEFAULT NULL,
  `hero_title_line_1` varchar(255) DEFAULT NULL,
  `hero_title_line_2` varchar(255) DEFAULT NULL,
  `hero_title_line_3` varchar(255) DEFAULT NULL,
  `hero_paragraph` text DEFAULT NULL,
  `hero_cta_primary_label` varchar(255) DEFAULT NULL,
  `hero_cta_primary_url` varchar(255) DEFAULT NULL,
  `hero_cta_secondary_label` varchar(255) DEFAULT NULL,
  `hero_cta_secondary_url` varchar(255) DEFAULT NULL,
  `hero_badge_text` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `about_heading` varchar(255) DEFAULT NULL,
  `about_body` text DEFAULT NULL,
  `about_image` varchar(255) DEFAULT NULL,
  `process_heading` varchar(255) DEFAULT NULL,
  `process_kicker` varchar(255) DEFAULT NULL,
  `process_overview` text DEFAULT NULL,
  `quote_heading` varchar(255) DEFAULT NULL,
  `quote_body` text DEFAULT NULL,
  `quote_button_label` varchar(255) DEFAULT NULL,
  `quote_button_url` varchar(255) DEFAULT NULL,
  `team_heading` varchar(255) DEFAULT NULL,
  `team_kicker` varchar(255) DEFAULT NULL,
  `team_overview` text DEFAULT NULL,
  `contact_company` varchar(255) DEFAULT NULL,
  `contact_address` varchar(255) DEFAULT NULL,
  `contact_phone_primary` varchar(255) DEFAULT NULL,
  `contact_phone_secondary` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `footer_tagline` text DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `footer_copyright` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `settings`
INSERT INTO `settings` (`id`, `company_name`, `short_name`, `tagline`, `logo`, `favicon`, `meta_title`, `meta_description`, `hero_kicker`, `hero_heading_line1`, `hero_heading_line2`, `hero_heading_line3`, `hero_paragraph`, `hero_primary_button_text`, `hero_primary_button_link`, `hero_secondary_button_text`, `hero_secondary_button_link`, `hero_image`, `hero_badge_title`, `hero_badge_text`, `about_kicker`, `about_heading`, `about_body`, `about_image`, `process_kicker`, `process_heading`, `process_intro`, `team_kicker`, `team_heading`, `team_intro`, `quote_kicker`, `quote_heading`, `quote_text`, `quote_button_text`, `quote_button_link`, `contact_kicker`, `contact_heading`, `contact_intro`, `contact_company`, `contact_address`, `contact_phone`, `contact_email`, `footer_about`, `footer_copyright`, `created_at`, `updated_at`) VALUES
(1, 'Adorn Trading PLC', 'Adorn', 'Design. Source. Deliver.', 'images/logo.png', NULL, 'Adorn Trading PLC | Design. Source. Deliver.', 'Adorn Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.', 'Global Wholesale Furnishing', 'Design.', 'Source.', 'Deliver.', 'Adorn Trading PLC brings premium interior finishing, furnishing and building-material solutions to Ethiopia through local project expertise and trusted global sourcing partnerships.', 'Explore Products', '#products', 'Request a Quote', '#contact', 'images/hero.jpg', 'ADDIS ABABA · ETHIOPIA', 'Interior finishing • Procurement • Project management', 'About Adorn Trading PLC', 'A local partner with a global supply vision.', 'Adorn Trading PLC is positioned as an Ethiopian interior finishing and design firm based in Addis Ababa, serving residential villas, commercial offices and multi-unit apartments.', 'images/about.jpg', 'How We Work', 'A clear five-step workflow.', 'From architectural layout review and detailed quotations to factory production QC and on-site installation in Ethiopia.', 'Leadership & Partners', 'Local leadership with global execution.', 'Founded by Abdulhamid Sherefa Negashe and Ayub Nuredin Negashe, combining on-the-ground Ethiopian project execution with direct international manufacturing partnerships.', 'Showroom & Design Hub', 'Experience the materials before you build.', 'Our Addis Ababa showroom concept is designed to bring kitchens, wardrobes, tiles, sanitary ware, aluminium systems, lighting, furniture and material samples together with consultation and design support.', 'Plan a Showroom Visit', '#contact', 'Start a Project', 'Tell us what you are building.', 'Send your project type, location, drawings or material requirements. Adorn Trading PLC can coordinate the next step.', 'Adorn Trading PLC', 'Addis Ababa, Ethiopia', '+251 9… / +251 7…', 'info@adorntrading.com', 'Design. Source. Deliver. Premium interior finishing, procurement and project support for Ethiopia.', '© 2026 Adorn Trading PLC. All rights reserved.', '2026-09-26 05:49:47', '2026-09-26 05:49:47');

-- Table structure for `products`
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number_label` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `products`
INSERT INTO `products` (`id`, `number_label`, `title`, `description`, `image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 01, 'Kitchen Cabinets', 'Custom kitchen systems and project-ready cabinetry.', 'images/products/kitchen-cabinets.jpg', 1, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(2, 02, 'Wardrobes & Closets', 'Built-in wardrobe and storage solutions.', 'images/products/wardrobes-closets.jpg', 2, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(3, 03, 'Tiles & Surfaces', 'Interior surface materials for residential and commercial projects.', 'images/products/tiles-surfaces.jpg', 3, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(4, 04, 'Sanitary Ware', 'Bathroom fixtures and coordinated sanitary solutions.', 'images/products/sanitary-ware.jpg', 4, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(5, 05, 'Aluminium Windows & Doors', 'Project-ready aluminium systems and openings.', 'images/products/aluminium-windows-doors.jpg', 5, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(6, 06, 'Lighting', 'Lighting solutions for complete interior schemes.', 'images/products/lighting.jpg', 6, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(7, 07, 'Furniture & Décor', 'Furniture and décor packages for finished spaces.', 'images/products/furniture-decor.jpg', 7, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(8, 08, 'Material Samples', 'Sample-led selection and client approval before ordering.', 'images/products/material-samples.jpg', 8, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20');

-- Table structure for `services`
DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'heroicon-o-cube',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `services`
INSERT INTO `services` (`id`, `icon`, `title`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'heroicon-o-clipboard-document-check', 'Project Management', 'Client engagement, site measurements, architectural layouts and full coordination.', 1, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(2, 'heroicon-o-wrench-screwdriver', 'Interior Fitting & Installation', 'Local physical assembly, craftsmanship and turnkey on-site installation across Ethiopia.', 2, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(3, 'heroicon-o-globe-americas', 'Global Procurement', 'Factory-direct sourcing, container consolidation and international supply chain coordination.', 3, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(4, 'heroicon-o-building-office-2', 'Architectural & Developer Solutions', 'Tailored interior solutions for luxury private villas, real-estate mock-up apartments, boutique hotels and commercial offices.', 4, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20');

-- Table structure for `process_steps`
DROP TABLE IF EXISTS `process_steps`;
CREATE TABLE IF NOT EXISTS `process_steps` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `step_label` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `process_steps`
INSERT INTO `process_steps` (`id`, `step_label`, `title`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'STEP 01', 'Project Brief', 'Architectural layouts, site measurements and design briefs are shared.', 1, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(2, 'STEP 02', 'Design & Quotation', '3D renderings, production drawings, itemized BOQ and pricing.', 2, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(3, 'STEP 03', 'Samples & Agreement', 'Materials are reviewed and approved before order confirmation.', 3, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(4, 'STEP 04', 'Production & QC', 'Manufacturing, photo/video QC, export packing and container loading.', 4, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(5, 'STEP 05', 'Delivery & Installation', 'Customs clearance, transport and on-site installation in Ethiopia.', 5, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20');

-- Table structure for `gallery_items`
DROP TABLE IF EXISTS `gallery_items`;
CREATE TABLE IF NOT EXISTS `gallery_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `gallery_items`
INSERT INTO `gallery_items` (`id`, `title`, `caption`, `description`, `explanation`, `image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Signature Interiors', '01 · SIGNATURE INTERIORS', 'Warm wood, marble and architectural lighting in open luxury living spaces.', 'Bespoke interior finishing designed for high-end residential villas and luxury apartments. Featuring book-matched Italian marble feature walls, architectural timber acoustic paneling, and layered ambient LED lighting tailored for modern Ethiopian living.', 'images/gallery-1.jpg', 1, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(2, 'Kitchen Solutions', '02 · KITCHEN SOLUTIONS', 'Premium custom cabinetry, integrated islands, and coordinated kitchen surfaces.', 'Turnkey German and Italian inspired kitchen systems crafted with scratch-resistant quartz waterfall countertops, soft-close hardware, integrated hidden appliances, and custom pantry joinery directly sourced from premier manufacturers.', 'images/gallery-2.jpg', 2, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(3, 'Showroom Experience', '03 · SHOWROOM EXPERIENCE', 'Material sample displays, architectural profiles, and personalized design consultation.', 'Our Addis Ababa design hub and showroom brings physical material samples, sanitary fixtures, thermal-break aluminium window profiles, and luxury tile collections together for hands-on evaluation, 3D render review, and consultation before procurement.', 'images/gallery-3.jpg', 3, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20');

-- Table structure for `team_members`
DROP TABLE IF EXISTS `team_members`;
CREATE TABLE IF NOT EXISTS `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `team_members`
INSERT INTO `team_members` (`id`, `name`, `role`, `bio`, `photo`, `linkedin_url`, `email`, `sort_order`, `is_active`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Abdulhamid Sherefa Negashe', 'Co-Founder & Managing Director', 'Co-founder leading client engagement, strategic partnerships, and operations across Ethiopian residential and commercial finishing projects.', NULL, 'https://linkedin.com', 'abdulhamid@adorntrading.com', 1, 1, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(2, 'Ayub Nuredin Negashe', 'Co-Founder & Head of Procurement', 'Co-founder managing international supply chains, global manufacturer relations, and end-to-end container logistics.', NULL, 'https://linkedin.com', 'ayub@adorntrading.com', 2, 1, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(3, 'Selamawit Tadesse', 'Lead Interior Designer', 'Specializing in luxury residential interior concepts, custom cabinetry layouts, and coordinated material boards.', NULL, 'https://linkedin.com', 'selamawit@adorntrading.com', 3, 1, 1, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(4, 'Dawit Bekele', 'Senior Project Architect', 'Overseeing technical drawings, site measurements, and precision on-site installation across multi-unit developments.', NULL, 'https://linkedin.com', 'dawit@adorntrading.com', 4, 1, 0, '2026-09-26 05:52:20', '2026-09-26 05:52:20'),
(5, 'Hanna Girma', 'Client Relations & Showroom Manager', 'Dedicated to sample approvals, personalized client consultations, and post-installation support.', NULL, 'https://linkedin.com', 'hanna@adorntrading.com', 5, 1, 0, '2026-09-26 05:52:20', '2026-09-26 05:52:20');

-- Table structure for `projects`
DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `body` longtext NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `projects`
INSERT INTO `projects` (`id`, `title`, `slug`, `client`, `location`, `year`, `category`, `excerpt`, `body`, `cover_image`, `is_active`, `sort_order`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Bole Luxury Villa Interior', 'bole-luxury-villa-interior', 'Private Client', 'Bole, Addis Ababa', 2026, 'Residential Villa', 'Turnkey interior finishing, custom kitchen cabinetry, walk-in closets, and Italian marble surfaces for a private luxury residence.', 'Complete interior finishing and turnkey procurement for a three-story luxury villa in Bole. Adorn Trading PLC managed the full scope from site measurement and 3D architectural rendering to direct factory procurement, container logistics, and on-site assembly. Features custom handle-less kitchen systems, walk-in wardrobes, luxury sanitary fixtures, and integrated ambient lighting schemes.', 'projects/bole-villa-cover.jpg', 1, 1, 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(2, 'CMC Real Estate Mock-Up Apartments', 'cmc-real-estate-mock-up-apartments', 'Apex Real Estate Developments', 'CMC, Addis Ababa', 2026, 'Apartment / Real Estate', 'Standardized, high-durability apartment finishing packages for developer sales mock-up units.', 'Developed turnkey interior mock-up units for a premium residential development in CMC. Sourced and installed modular kitchen cabinets, porcelain tiles, aluminium doors and windows, and coordinated sanitary packages optimized for developer budgets and rapid construction timelines.', 'projects/cmc-apartments-cover.jpg', 1, 2, 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(3, 'Kazanchis Financial District Corporate Offices', 'kazanchis-corporate-offices', 'Horizon Corporate Group', 'Kazanchis, Addis Ababa', 2025, 'Commercial Office', 'Modern commercial interior solutions featuring glass partitions, acoustic ceilings, and ergonomic executive furniture.', 'Provided end-to-end commercial interior finishing for corporate headquarters in the Kazanchis financial hub. The package included tempered glass office partitions, commercial-grade acoustic ceiling panels, energy-efficient architectural LED lighting, and executive boardrooms.', 'projects/kazanchis-offices-cover.jpg', 1, 3, 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(4, 'Bishoftu Lakeview Boutique Hotel Suites', 'bishoftu-lakeview-boutique-hotel', 'Lakeview Hospitality Partners', 'Bishoftu, Oromia', 2025, 'Hospitality', 'Hospitality-grade furnishings, outdoor aluminium sliders, and custom guest room casework.', 'Outfitted 24 boutique suites overlooking Lake Babogaya. Delivered weather-resistant aluminium sliding glass systems, custom teak headboards, vanities, mini-bar joinery, and durable contract fabrics tailored for resort environments.', 'projects/bishoftu-resort-cover.jpg', 1, 4, 0, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(5, 'Adorn Flagship Showroom & Material Hub', 'adorn-flagship-showroom', 'Adorn Trading PLC', 'Addis Ababa', 2026, 'Showroom', 'Interactive material exhibition space showcasing live kitchen vignettes, tile displays, and profile mock-ups.', 'Our flagship showroom concept designed to provide architects, interior designers, and developers a physical space to touch, test, and specify materials before container orders are committed. Features full-scale kitchen models, lighting temperature displays, and raw material sample libraries.', 'projects/adorn-showroom-cover.jpg', 1, 5, 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21');

-- Table structure for `project_images`
DROP TABLE IF EXISTS `project_images`;
CREATE TABLE IF NOT EXISTS `project_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_images_project_id_foreign` (`project_id`),
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for `project_images`
INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `caption`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'projects/bole-villa-1.jpg', 'Open-concept living room with marble feature wall', 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(2, 1, 'projects/bole-villa-2.jpg', 'Custom island kitchen with quartz countertops', 2, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(3, 1, 'projects/bole-villa-3.jpg', 'Master suite with bespoke walk-in closet', 3, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(4, 2, 'projects/cmc-apartments-1.jpg', 'Model two-bedroom apartment living space', 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(5, 2, 'projects/cmc-apartments-2.jpg', 'Space-efficient modular kitchen layout', 2, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(6, 2, 'projects/cmc-apartments-3.jpg', 'Coordinated bathroom fixtures and wall tiling', 3, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(7, 3, 'projects/kazanchis-offices-1.jpg', 'Executive boardroom with integrated acoustic panels', 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(8, 3, 'projects/kazanchis-offices-2.jpg', 'Open-plan workstation area with linear architectural lighting', 2, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(9, 4, 'projects/bishoftu-resort-1.jpg', 'Lakeview suite bedroom with panoramic sliders', 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(10, 4, 'projects/bishoftu-resort-2.jpg', 'Custom terrazzo vanity and freestanding bath', 2, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(11, 5, 'projects/adorn-showroom-1.jpg', 'Main showroom kitchen display with premium stone countertops', 1, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(12, 5, 'projects/adorn-showroom-2.jpg', 'Material sample library and consultation lounge', 2, '2026-09-26 05:52:21', '2026-09-26 05:52:21'),
(13, 5, 'projects/adorn-showroom-3.jpg', 'Architectural aluminium systems and hardware display', 3, '2026-09-26 05:52:21', '2026-09-26 05:52:21');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
