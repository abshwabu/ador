<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Products (Homepage "Products" cards)
        $products = [
            [
                'number_label' => '01',
                'title' => 'Kitchen Cabinets',
                'description' => 'Custom kitchen systems and project-ready cabinetry.',
                'image' => 'images/products/kitchen-cabinets.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'number_label' => '02',
                'title' => 'Wardrobes & Closets',
                'description' => 'Built-in wardrobe and storage solutions.',
                'image' => 'images/products/wardrobes-closets.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'number_label' => '03',
                'title' => 'Tiles & Surfaces',
                'description' => 'Interior surface materials for residential and commercial projects.',
                'image' => 'images/products/tiles-surfaces.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'number_label' => '04',
                'title' => 'Sanitary Ware',
                'description' => 'Bathroom fixtures and coordinated sanitary solutions.',
                'image' => 'images/products/sanitary-ware.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'number_label' => '05',
                'title' => 'Aluminium Windows & Doors',
                'description' => 'Project-ready aluminium systems and openings.',
                'image' => 'images/products/aluminium-windows-doors.jpg',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'number_label' => '06',
                'title' => 'Lighting',
                'description' => 'Lighting solutions for complete interior schemes.',
                'image' => 'images/products/lighting.jpg',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'number_label' => '07',
                'title' => 'Furniture & Décor',
                'description' => 'Furniture and décor packages for finished spaces.',
                'image' => 'images/products/furniture-decor.jpg',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'number_label' => '08',
                'title' => 'Material Samples',
                'description' => 'Sample-led selection and client approval before ordering.',
                'image' => 'images/products/material-samples.jpg',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['title' => $product['title']],
                $product
            );
        }

        // 2. Services ("Solutions" section)
        $services = [
            [
                'icon' => 'heroicon-o-clipboard-document-check',
                'title' => 'Project Management',
                'description' => 'Client engagement, site measurements, architectural layouts and full coordination.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'icon' => 'heroicon-o-wrench-screwdriver',
                'title' => 'Interior Fitting & Installation',
                'description' => 'Local physical assembly, craftsmanship and turnkey on-site installation across Ethiopia.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'icon' => 'heroicon-o-globe-americas',
                'title' => 'Global Procurement',
                'description' => 'Factory-direct sourcing, container consolidation and international supply chain coordination.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'icon' => 'heroicon-o-building-office-2',
                'title' => 'Architectural & Developer Solutions',
                'description' => 'Tailored interior solutions for luxury private villas, real-estate mock-up apartments, boutique hotels and commercial offices.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }

        // 3. ProcessSteps ("How We Work" section)
        $steps = [
            [
                'step_label' => 'STEP 01',
                'title' => 'Project Brief',
                'description' => 'Architectural layouts, site measurements and design briefs are shared.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'step_label' => 'STEP 02',
                'title' => 'Design & Quotation',
                'description' => '3D renderings, production drawings, itemized BOQ and pricing.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'step_label' => 'STEP 03',
                'title' => 'Samples & Agreement',
                'description' => 'Materials are reviewed and approved before order confirmation.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'step_label' => 'STEP 04',
                'title' => 'Production & QC',
                'description' => 'Manufacturing, photo/video QC, export packing and container loading.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'step_label' => 'STEP 05',
                'title' => 'Delivery & Installation',
                'description' => 'Customs clearance, transport and on-site installation in Ethiopia.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            ProcessStep::updateOrCreate(
                ['title' => $step['title']],
                $step
            );
        }

        // 4. GalleryItems (Homepage "Showroom" gallery)
        $galleryItems = [
            [
                'title' => 'Signature Interiors',
                'caption' => '01 · SIGNATURE INTERIORS',
                'description' => 'Warm wood, marble and architectural lighting in open luxury living spaces.',
                'explanation' => 'Bespoke interior finishing designed for high-end residential villas and luxury apartments. Featuring book-matched Italian marble feature walls, architectural timber acoustic paneling, and layered ambient LED lighting tailored for modern Ethiopian living.',
                'image' => 'images/gallery-1.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Kitchen Solutions',
                'caption' => '02 · KITCHEN SOLUTIONS',
                'description' => 'Premium custom cabinetry, integrated islands, and coordinated kitchen surfaces.',
                'explanation' => 'Turnkey German and Italian inspired kitchen systems crafted with scratch-resistant quartz waterfall countertops, soft-close hardware, integrated hidden appliances, and custom pantry joinery directly sourced from premier manufacturers.',
                'image' => 'images/gallery-2.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Showroom Experience',
                'caption' => '03 · SHOWROOM EXPERIENCE',
                'description' => 'Material sample displays, architectural profiles, and personalized design consultation.',
                'explanation' => 'Our Addis Ababa design hub and showroom brings physical material samples, sanitary fixtures, thermal-break aluminium window profiles, and luxury tile collections together for hands-on evaluation, 3D render review, and consultation before procurement.',
                'image' => 'images/gallery-3.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($galleryItems as $item) {
            GalleryItem::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }

        // 5. TeamMembers
        $teamMembers = [
            [
                'name' => 'Abdulhamid Sherefa Negashe',
                'role' => 'Co-Founder & Managing Director',
                'bio' => 'Co-founder leading client engagement, strategic partnerships, and operations across Ethiopian residential and commercial finishing projects.',
                'photo' => null,
                'linkedin_url' => 'https://linkedin.com',
                'email' => 'abdulhamid@adorntrading.com',
                'sort_order' => 1,
                'is_active' => true,
                'featured' => true,
            ],
            [
                'name' => 'Ayub Nuredin Negashe',
                'role' => 'Co-Founder & Head of Procurement',
                'bio' => 'Co-founder managing international supply chains, global manufacturer relations, and end-to-end container logistics.',
                'photo' => null,
                'linkedin_url' => 'https://linkedin.com',
                'email' => 'ayub@adorntrading.com',
                'sort_order' => 2,
                'is_active' => true,
                'featured' => true,
            ],
            [
                'name' => 'Selamawit Tadesse',
                'role' => 'Lead Interior Designer',
                'bio' => 'Specializing in luxury residential interior concepts, custom cabinetry layouts, and coordinated material boards.',
                'photo' => null,
                'linkedin_url' => 'https://linkedin.com',
                'email' => 'selamawit@adorntrading.com',
                'sort_order' => 3,
                'is_active' => true,
                'featured' => true,
            ],
            [
                'name' => 'Dawit Bekele',
                'role' => 'Senior Project Architect',
                'bio' => 'Overseeing technical drawings, site measurements, and precision on-site installation across multi-unit developments.',
                'photo' => null,
                'linkedin_url' => 'https://linkedin.com',
                'email' => 'dawit@adorntrading.com',
                'sort_order' => 4,
                'is_active' => true,
                'featured' => false,
            ],
            [
                'name' => 'Hanna Girma',
                'role' => 'Client Relations & Showroom Manager',
                'bio' => 'Dedicated to sample approvals, personalized client consultations, and post-installation support.',
                'photo' => null,
                'linkedin_url' => 'https://linkedin.com',
                'email' => 'hanna@adorntrading.com',
                'sort_order' => 5,
                'is_active' => true,
                'featured' => false,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                $member
            );
        }
    }
}
