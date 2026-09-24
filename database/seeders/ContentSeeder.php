<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\Service;
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
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'number_label' => '02',
                'title' => 'Wardrobes & Closets',
                'description' => 'Built-in wardrobe and storage solutions.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'number_label' => '03',
                'title' => 'Tiles & Surfaces',
                'description' => 'Interior surface materials for residential and commercial projects.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'number_label' => '04',
                'title' => 'Sanitary Ware',
                'description' => 'Bathroom fixtures and coordinated sanitary solutions.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'number_label' => '05',
                'title' => 'Aluminium Windows & Doors',
                'description' => 'Project-ready aluminium systems and openings.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'number_label' => '06',
                'title' => 'Lighting',
                'description' => 'Lighting solutions for complete interior schemes.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'number_label' => '07',
                'title' => 'Furniture & Décor',
                'description' => 'Furniture and décor packages for finished spaces.',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'number_label' => '08',
                'title' => 'Material Samples',
                'description' => 'Sample-led selection and client approval before ordering.',
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
                'image' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Kitchen Solutions',
                'caption' => '02 · KITCHEN SOLUTIONS',
                'description' => 'Premium custom cabinetry, integrated islands, and coordinated kitchen surfaces.',
                'image' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Showroom Experience',
                'caption' => '03 · SHOWROOM EXPERIENCE',
                'description' => 'Material sample displays, architectural profiles, and personalized design consultation.',
                'image' => null,
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
    }
}
