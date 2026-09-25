<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Setting;
use Database\Seeders\ContentSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_shared_layout_renders_on_all_pages_with_nav_and_footer(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);
        $this->seed(ProjectSeeder::class);

        $urls = [
            '/',
            '/team',
            '/portfolio',
            '/portfolio/bole-luxury-villa-interior',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);

            $response->assertSuccessful();

            // Brand & Logo
            $response->assertSee('Adorn Trading PLC');
            $response->assertSee('images/logo.png');

            // Shared Nav Links
            $response->assertSee(route('portfolio.index'));
            $response->assertSee(route('team.index'));

            // Shared Footer Content from Setting
            $response->assertSee('Design. Source. Deliver.');
            $response->assertSee('© 2026 Adorn Trading PLC. All rights reserved.');

            // Rebranding safety
            $response->assertDontSee('MIRADEN', false);
        }
    }

    public function test_nav_and_footer_dynamically_update_when_settings_change(): void
    {
        $this->seed(SettingSeeder::class);

        // Update settings record
        $setting = Setting::first();
        $setting->update([
            'company_name' => 'Adorn Trading PLC Worldwide',
            'tagline' => 'Design. Source. Deliver. Ethiopia',
            'footer_copyright' => '© 2026 Custom Adorn Copyright Line',
        ]);

        $response = $this->get('/');
        $response->assertSuccessful();

        $response->assertSee('Adorn Trading PLC Worldwide');
        $response->assertSee('Design. Source. Deliver. Ethiopia');
        $response->assertSee('© 2026 Custom Adorn Copyright Line');
    }
}
