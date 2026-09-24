<?php

namespace Tests\Feature;

use App\Filament\Pages\ManageSettings;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\SettingSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ManageSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_manage_settings(): void
    {
        $response = $this->get('/admin/manage-settings');
        $response->assertRedirect('/admin/login');
    }

    public function test_authenticated_user_can_access_manage_settings(): void
    {
        $this->seed(SettingSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/manage-settings');
        $response->assertSuccessful();
        $response->assertSee('Homepage Settings');
        $response->assertSee('Brand');
        $response->assertSee('Hero');
        $response->assertSee('About');
        $response->assertSee('Process');
        $response->assertSee('Team');
        $response->assertSee('Quote/CTA');
        $response->assertSee('Contact');
        $response->assertSee('Footer');
        $response->assertSee('SEO');
    }

    public function test_can_save_settings_via_livewire(): void
    {
        $this->seed(SettingSeeder::class);
        $user = User::factory()->create();
        $this->actingAs($user);

        Filament::setCurrentPanel(Filament::getPanel('admin'));

        Livewire::test(ManageSettings::class)
            ->fillForm([
                'company_name' => 'Adron Trading PLC Updated',
                'tagline' => 'Design. Source. Deliver. Better.',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('settings', [
            'id' => 1,
            'company_name' => 'Adron Trading PLC Updated',
            'tagline' => 'Design. Source. Deliver. Better.',
        ]);
    }
}
