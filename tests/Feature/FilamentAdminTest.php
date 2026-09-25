<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_admin_login(): void
    {
        $response = $this->get("/admin");
        $response->assertRedirect("/admin/login");
    }

    public function test_can_render_login_page(): void
    {
        $response = $this->get("/admin/login");
        $response->assertSuccessful();
        $response->assertSee("Adorn Trading PLC");
    }

    public function test_admin_can_authenticate_via_filament_login(): void
    {
        $user = User::factory()->create([
            "email" => "admin@adorn.com",
            "password" => "password",
        ]);

        Filament::setCurrentPanel(Filament::getPanel("admin"));

        Livewire::test(Login::class)
            ->fillForm([
                "email" => "admin@adorn.com",
                "password" => "password",
            ])
            ->call("authenticate")
            ->assertHasNoFormErrors()
            ->assertRedirect("/admin");

        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_access_dashboard(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/admin");
        $response->assertSuccessful();
        $response->assertSee("Adorn Trading PLC");
    }

    public function test_landing_page_renders_with_rebranded_content(): void
    {
        $response = $this->get("/");
        $response->assertSuccessful();
        $response->assertSee("Adorn Trading PLC");
        $response->assertSee("Design. Source. Deliver.");
        $response->assertDontSee("MIRADEN");
    }
}
