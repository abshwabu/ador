<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Database\Seeders\ContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourcesTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_populates_all_sections(): void
    {
        $this->seed(ContentSeeder::class);

        $this->assertDatabaseCount('products', 8);
        $this->assertDatabaseHas('products', [
            'number_label' => '01',
            'title' => 'Kitchen Cabinets',
        ]);

        $this->assertDatabaseCount('services', 4);
        $this->assertDatabaseHas('services', [
            'title' => 'Project Management',
        ]);

        $this->assertDatabaseCount('process_steps', 5);
        $this->assertDatabaseHas('process_steps', [
            'step_label' => 'STEP 01',
            'title' => 'Project Brief',
        ]);

        $this->assertDatabaseCount('gallery_items', 3);
        $this->assertDatabaseHas('gallery_items', [
            'title' => 'Signature Interiors',
        ]);

        $this->assertDatabaseCount('team_members', 5);
        $this->assertDatabaseHas('team_members', [
            'name' => 'Abdulhamid Sherefa Negashe',
            'featured' => true,
        ]);
    }

    public function test_admin_can_access_products_resource(): void
    {
        $this->seed(ContentSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/products');
        $response->assertSuccessful();
        $response->assertSee('Kitchen Cabinets');
    }

    public function test_admin_can_access_services_resource(): void
    {
        $this->seed(ContentSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/services');
        $response->assertSuccessful();
        $response->assertSee('Project Management');
    }

    public function test_admin_can_access_process_steps_resource(): void
    {
        $this->seed(ContentSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/process-steps');
        $response->assertSuccessful();
        $response->assertSee('Project Brief');
    }

    public function test_admin_can_access_gallery_items_resource(): void
    {
        $this->seed(ContentSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/gallery-items');
        $response->assertSuccessful();
        $response->assertSee('Signature Interiors');
    }

    public function test_admin_can_access_team_members_resource(): void
    {
        $this->seed(ContentSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/team-members');
        $response->assertSuccessful();
        $response->assertSee('Abdulhamid Sherefa Negashe');
        $response->assertSee('Ayub Nuredin Negashe');
    }

    public function test_admin_can_access_projects_resource(): void
    {
        $this->seed(\Database\Seeders\ProjectSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/projects');
        $response->assertSuccessful();
        $response->assertSee('Bole Luxury Villa Interior');
        $response->assertSee('CMC Real Estate Mock-Up Apartments');
    }

    public function test_admin_can_view_project_edit_page_with_images_relation(): void
    {
        $this->seed(\Database\Seeders\ProjectSeeder::class);
        $user = User::factory()->create();
        $project = \App\Models\Project::first();

        $response = $this->actingAs($user)->get("/admin/projects/{$project->id}/edit");
        $response->assertSuccessful();
        $response->assertSee($project->title);
        $response->assertSee('Gallery Images');
    }
}
