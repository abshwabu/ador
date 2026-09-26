<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\ProjectImage;
use Database\Seeders\ContentSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_index_page_loads_and_displays_active_projects(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ProjectSeeder::class);

        // Create an inactive project to verify it gets filtered out
        Project::create([
            'title' => 'Secret Inactive Mansion',
            'slug' => 'secret-inactive-mansion',
            'client' => 'Confidential',
            'location' => 'Addis Ababa',
            'year' => '2026',
            'category' => 'Residential Villa',
            'excerpt' => 'This inactive project must not be displayed.',
            'body' => 'Hidden body text.',
            'is_active' => false,
            'sort_order' => 99,
        ]);

        $response = $this->get('/portfolio');

        $response->assertSuccessful();

        // Check seeded projects are visible
        $response->assertSee('Bole Luxury Villa Interior');
        $response->assertSee('Residential Villa');
        $response->assertSee('Turnkey interior finishing, custom kitchen cabinetry');

        $response->assertSee('CMC Real Estate Mock-Up Apartments');
        $response->assertSee('Apartment / Real Estate');

        $response->assertSee('Kazanchis Financial District Corporate Offices');
        $response->assertSee('Commercial Office');

        // Check links to detail pages
        $response->assertSee(route('portfolio.show', 'bole-luxury-villa-interior'));
        $response->assertSee(route('portfolio.show', 'cmc-real-estate-mock-up-apartments'));

        // Check inactive project is hidden
        $response->assertDontSee('Secret Inactive Mansion');

        // Rebrand checks
        $response->assertSee('Adorn Trading PLC');
        $response->assertDontSee('MIRADEN', false);
    }

    public function test_portfolio_detail_page_renders_full_project_information(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ProjectSeeder::class);

        $project = Project::where('slug', 'bole-luxury-villa-interior')->firstOrFail();

        $response = $this->get('/portfolio/bole-luxury-villa-interior');

        $response->assertSuccessful();

        // Project details
        $response->assertSee($project->title);
        $response->assertSee($project->client);
        $response->assertSee($project->location);
        $response->assertSee($project->year);
        $response->assertSee($project->category);
        $response->assertSee($project->body);

        // Gallery images & lightbox elements
        $this->assertTrue($project->images()->count() > 0);
        $response->assertSee('project-gallery-grid');
        $response->assertSee('project-gallery-item');
        $response->assertSee('projectLightbox');
        $response->assertSee('Enlarge Photo');
        foreach ($project->images as $image) {
            if ($image->caption) {
                $response->assertSee($image->caption);
            }
        }

        // Rebrand & supplier checks
        $response->assertSee('Adorn Trading PLC');
        $response->assertDontSee('MIRADEN', false);
        $response->assertDontSee('Foshan', false);
    }

    public function test_portfolio_detail_returns_404_for_non_existent_project(): void
    {
        $this->seed(SettingSeeder::class);

        $response = $this->get('/portfolio/non-existent-project-slug');

        $response->assertNotFound();
    }

    public function test_portfolio_detail_returns_404_for_inactive_project(): void
    {
        $this->seed(SettingSeeder::class);

        $inactive = Project::create([
            'title' => 'Draft Unpublished Project',
            'slug' => 'draft-unpublished-project',
            'client' => 'Private Client',
            'location' => 'Addis Ababa',
            'year' => '2026',
            'category' => 'Residential',
            'excerpt' => 'Draft excerpt',
            'body' => 'Draft body',
            'is_active' => false,
            'sort_order' => 1,
        ]);

        $response = $this->get('/portfolio/' . $inactive->slug);

        $response->assertNotFound();
    }
}
