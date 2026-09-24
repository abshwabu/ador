<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Bole Luxury Villa Interior',
                'slug' => 'bole-luxury-villa-interior',
                'client' => 'Private Client',
                'location' => 'Bole, Addis Ababa',
                'year' => '2026',
                'category' => 'Residential Villa',
                'excerpt' => 'Turnkey interior finishing, custom kitchen cabinetry, walk-in closets, and Italian marble surfaces for a private luxury residence.',
                'body' => 'Complete interior finishing and turnkey procurement for a three-story luxury villa in Bole. Adron Trading PLC managed the full scope from site measurement and 3D architectural rendering to direct factory procurement in Foshan, container logistics, and on-site assembly. Features custom handle-less kitchen systems, walk-in wardrobes, luxury sanitary fixtures, and integrated ambient lighting schemes.',
                'cover_image' => 'projects/bole-villa-cover.jpg',
                'sort_order' => 1,
                'is_active' => true,
                'featured' => true,
                'images' => [
                    ['image_path' => 'projects/bole-villa-1.jpg', 'caption' => 'Open-concept living room with marble feature wall', 'sort_order' => 1],
                    ['image_path' => 'projects/bole-villa-2.jpg', 'caption' => 'Custom island kitchen with quartz countertops', 'sort_order' => 2],
                    ['image_path' => 'projects/bole-villa-3.jpg', 'caption' => 'Master suite with bespoke walk-in closet', 'sort_order' => 3],
                ],
            ],
            [
                'title' => 'CMC Real Estate Mock-Up Apartments',
                'slug' => 'cmc-real-estate-mock-up-apartments',
                'client' => 'Apex Real Estate Developments',
                'location' => 'CMC, Addis Ababa',
                'year' => '2026',
                'category' => 'Apartment / Real Estate',
                'excerpt' => 'Standardized, high-durability apartment finishing packages for developer sales mock-up units.',
                'body' => 'Developed turnkey interior mock-up units for a premium residential development in CMC. Sourced and installed modular kitchen cabinets, porcelain tiles, aluminium doors and windows, and coordinated sanitary packages optimized for developer budgets and rapid construction timelines.',
                'cover_image' => 'projects/cmc-apartments-cover.jpg',
                'sort_order' => 2,
                'is_active' => true,
                'featured' => true,
                'images' => [
                    ['image_path' => 'projects/cmc-apartments-1.jpg', 'caption' => 'Model two-bedroom apartment living space', 'sort_order' => 1],
                    ['image_path' => 'projects/cmc-apartments-2.jpg', 'caption' => 'Space-efficient modular kitchen layout', 'sort_order' => 2],
                    ['image_path' => 'projects/cmc-apartments-3.jpg', 'caption' => 'Coordinated bathroom fixtures and wall tiling', 'sort_order' => 3],
                ],
            ],
            [
                'title' => 'Kazanchis Financial District Corporate Offices',
                'slug' => 'kazanchis-corporate-offices',
                'client' => 'Horizon Corporate Group',
                'location' => 'Kazanchis, Addis Ababa',
                'year' => '2025',
                'category' => 'Commercial Office',
                'excerpt' => 'Modern commercial interior solutions featuring glass partitions, acoustic ceilings, and ergonomic executive furniture.',
                'body' => 'Provided end-to-end commercial interior finishing for corporate headquarters in the Kazanchis financial hub. The package included tempered glass office partitions, commercial-grade acoustic ceiling panels, energy-efficient architectural LED lighting, and executive boardrooms.',
                'cover_image' => 'projects/kazanchis-offices-cover.jpg',
                'sort_order' => 3,
                'is_active' => true,
                'featured' => true,
                'images' => [
                    ['image_path' => 'projects/kazanchis-offices-1.jpg', 'caption' => 'Executive boardroom with integrated acoustic panels', 'sort_order' => 1],
                    ['image_path' => 'projects/kazanchis-offices-2.jpg', 'caption' => 'Open-plan workstation area with linear architectural lighting', 'sort_order' => 2],
                ],
            ],
            [
                'title' => 'Bishoftu Lakeview Boutique Hotel Suites',
                'slug' => 'bishoftu-lakeview-boutique-hotel',
                'client' => 'Lakeview Hospitality Partners',
                'location' => 'Bishoftu, Oromia',
                'year' => '2025',
                'category' => 'Hospitality',
                'excerpt' => 'Hospitality-grade furnishings, outdoor aluminium sliders, and custom guest room casework.',
                'body' => 'Outfitted 24 boutique suites overlooking Lake Babogaya. Delivered weather-resistant aluminium sliding glass systems, custom teak headboards, vanities, mini-bar joinery, and durable contract fabrics tailored for resort environments.',
                'cover_image' => 'projects/bishoftu-resort-cover.jpg',
                'sort_order' => 4,
                'is_active' => true,
                'featured' => false,
                'images' => [
                    ['image_path' => 'projects/bishoftu-resort-1.jpg', 'caption' => 'Lakeview suite bedroom with panoramic sliders', 'sort_order' => 1],
                    ['image_path' => 'projects/bishoftu-resort-2.jpg', 'caption' => 'Custom terrazzo vanity and freestanding bath', 'sort_order' => 2],
                ],
            ],
            [
                'title' => 'Adron Flagship Showroom & Material Hub',
                'slug' => 'adron-flagship-showroom',
                'client' => 'Adron Trading PLC',
                'location' => 'Addis Ababa',
                'year' => '2026',
                'category' => 'Showroom',
                'excerpt' => 'Interactive material exhibition space showcasing live kitchen vignettes, tile displays, and profile mock-ups.',
                'body' => 'Our flagship showroom concept designed to provide architects, interior designers, and developers a physical space to touch, test, and specify materials before container orders are committed. Features full-scale kitchen models, lighting temperature displays, and raw material sample libraries.',
                'cover_image' => 'projects/adron-showroom-cover.jpg',
                'sort_order' => 5,
                'is_active' => true,
                'featured' => true,
                'images' => [
                    ['image_path' => 'projects/adron-showroom-1.jpg', 'caption' => 'Main showroom kitchen display with premium stone countertops', 'sort_order' => 1],
                    ['image_path' => 'projects/adron-showroom-2.jpg', 'caption' => 'Material sample library and consultation lounge', 'sort_order' => 2],
                    ['image_path' => 'projects/adron-showroom-3.jpg', 'caption' => 'Architectural aluminium systems and hardware display', 'sort_order' => 3],
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $images = $projectData['images'] ?? [];
            unset($projectData['images']);

            $project = Project::updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData
            );

            // Re-seed project images
            $project->images()->delete();
            foreach ($images as $imgData) {
                $project->images()->create($imgData);
            }
        }
    }
}
