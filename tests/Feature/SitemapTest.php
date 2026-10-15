<?php

namespace Tests\Feature;

use App\Models\Project;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_returns_valid_xml_with_all_pages(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ProjectSeeder::class);

        $response = $this->get('/sitemap.xml');

        $response->assertSuccessful();
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        // Check essential routes
        $response->assertSee(route('home'));
        $response->assertSee(route('portfolio.index'));
        $response->assertSee(route('team.index'));

        // Check active projects in sitemap
        $projects = Project::where('is_active', true)->get();
        foreach ($projects as $project) {
            $response->assertSee(route('portfolio.show', $project->slug));
        }
    }

    public function test_homepage_includes_seo_meta_tags_and_structured_data(): void
    {
        $this->seed(SettingSeeder::class);

        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertSee('<meta name="robots" content="index, follow', false);
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('property="og:site_name" content="Adorn Trading PLC"', false);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('"name": "Adorn Trading PLC"', false);
        $response->assertSee('LocalBusiness', false);
    }
}
