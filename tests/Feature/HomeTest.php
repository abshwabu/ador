<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use Database\Seeders\ContentSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads_successfully_with_seeded_database(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');

        $response->assertSuccessful();

        // Brand & Settings
        $response->assertSee('Adorn Trading PLC');
        $response->assertSee('Design. Source. Deliver.');
        $response->assertSee('Global Wholesale Furnishing');
        $response->assertSee('A local partner with a global supply vision.');
        $response->assertSee('How We Work');
        $response->assertSee('Showroom & Design Hub');
        $response->assertSee('Tell us what you are building.');
        $response->assertSee('info@adorntrading.com');
        $response->assertSee('© 2026 Adorn Trading PLC. All rights reserved.');

        // Rebrand safety: No Miraden references anywhere
        $response->assertDontSee('MIRADEN', false);
        $response->assertDontSee('MIRADEN GLOBAL PLC', false);

        // Third-party supplier name safety: No George Group or Foshan
        $response->assertDontSee('George Group', false);
        $response->assertDontSee('George Group China', false);
        $response->assertDontSee('Foshan', false);
    }

    public function test_homepage_renders_all_dynamic_products_from_database(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');
        $response->assertSuccessful();

        $products = Product::where('is_active', true)->get();
        $this->assertCount(8, $products);

        foreach ($products as $product) {
            $response->assertSee($product->title);
            $response->assertSee($product->description);
            if ($product->number_label) {
                $response->assertSee($product->number_label);
            }
            if ($product->image) {
                $response->assertSee($product->image);
            }
        }
    }

    public function test_homepage_renders_dynamic_services_and_solutions(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');
        $response->assertSuccessful();

        $services = Service::where('is_active', true)->get();
        $this->assertCount(4, $services);

        foreach ($services as $service) {
            $response->assertSee($service->title);
            $response->assertSee($service->description);
        }
    }

    public function test_homepage_renders_dynamic_process_steps(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');
        $response->assertSuccessful();

        $steps = ProcessStep::where('is_active', true)->get();
        $this->assertCount(5, $steps);

        foreach ($steps as $step) {
            $response->assertSee($step->title);
            $response->assertSee($step->description);
            $response->assertSee($step->step_label);
        }
    }

    public function test_homepage_renders_dynamic_gallery_items(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');
        $response->assertSuccessful();

        $items = GalleryItem::where('is_active', true)->get();
        $this->assertCount(3, $items);

        foreach ($items as $item) {
            if ($item->caption) {
                $response->assertSee($item->caption);
            }
        }
    }

    public function test_homepage_renders_featured_team_members_and_links_to_team_page(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/');
        $response->assertSuccessful();

        // Featured members should be on the homepage
        $response->assertSee('Abdulhamid Sherefa Negashe');
        $response->assertSee('Ayub Nuredin Negashe');
        $response->assertSee('Selamawit Tadesse');

        // Link to /team
        $response->assertSee(route('team.index'));
        $response->assertSee('Meet Our Full Team');
    }

    public function test_team_page_renders_all_active_team_members(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        // Add an inactive team member to verify filtering
        TeamMember::create([
            'name' => 'Inactive Member Example',
            'role' => 'Former Intern',
            'bio' => 'Should not appear on team page.',
            'sort_order' => 99,
            'is_active' => false,
            'featured' => false,
        ]);

        $response = $this->get('/team');
        $response->assertSuccessful();

        // All active members should appear
        $response->assertSee('Abdulhamid Sherefa Negashe');
        $response->assertSee('Ayub Nuredin Negashe');
        $response->assertSee('Selamawit Tadesse');
        $response->assertSee('Dawit Bekele');
        $response->assertSee('Hanna Girma');

        // Inactive member must not appear
        $response->assertDontSee('Inactive Member Example');

        // Rebrand safety
        $response->assertSee('Adorn Trading PLC');
        $response->assertDontSee('MIRADEN', false);
        $response->assertDontSee('Foshan', false);
    }
}
