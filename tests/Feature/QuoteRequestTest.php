<?php

namespace Tests\Feature;

use App\Models\QuoteRequest;
use App\Models\User;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_quote_request_form(): void
    {
        $this->seed(SettingSeeder::class);

        $response = $this->get('/');
        $response->assertSuccessful();
        $response->assertSee('name="full_name"', false);
        $response->assertSee('name="city"', false);
        $response->assertSee('name="phone"', false);
        $response->assertSee('name="project_type"', false);
        $response->assertSee('name="message"', false);
        $response->assertSee(route('quote-requests.store'));
    }

    public function test_guest_can_submit_quote_request_successfully(): void
    {
        $payload = [
            'full_name' => 'Abebe Bikila',
            'company' => 'Bikila Logistics',
            'city' => 'Addis Ababa',
            'phone' => '+251 91 234 5678',
            'email' => 'abebe@bikilalogistics.com',
            'project_type' => 'Commercial Office',
            'message' => 'Need 12 modular office desks, meeting room partitions, and acoustic ceiling tiles for our new headquarters in Kazanchis.',
        ];

        $response = $this->post(route('quote-requests.store'), $payload);

        $response->assertRedirect(route('home') . '#contact');
        $response->assertSessionHas('quote_success');

        $this->assertDatabaseHas('quote_requests', [
            'full_name' => 'Abebe Bikila',
            'company' => 'Bikila Logistics',
            'city' => 'Addis Ababa',
            'phone' => '+251 91 234 5678',
            'email' => 'abebe@bikilalogistics.com',
            'project_type' => 'Commercial Office',
            'status' => QuoteRequest::STATUS_NEW,
        ]);
    }

    public function test_guest_can_submit_quote_request_via_ajax(): void
    {
        $payload = [
            'full_name' => 'Helen Getachew',
            'company' => 'Private Villa',
            'city' => 'Hawassa',
            'phone' => '+251 94 456 7890',
            'email' => 'helen@gmail.com',
            'project_type' => 'Private Villa',
            'message' => 'Custom quartz kitchen island, walk-in closets, and luxury bathroom sanitary ware.',
        ];

        $response = $this->postJson(route('quote-requests.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('quote_requests', [
            'full_name' => 'Helen Getachew',
            'city' => 'Hawassa',
            'status' => QuoteRequest::STATUS_NEW,
        ]);
    }

    public function test_quote_request_validation_fails_for_missing_required_fields(): void
    {
        $response = $this->post(route('quote-requests.store'), [
            'company' => 'Only Company',
        ]);

        $response->assertSessionHasErrors(['full_name', 'phone', 'message']);
        $this->assertDatabaseCount('quote_requests', 0);
    }

    public function test_admin_can_access_quote_requests_resource_in_filament(): void
    {
        $this->seed(SettingSeeder::class);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@adorn.com',
            'password' => bcrypt('password'),
        ]);

        $quote = QuoteRequest::create([
            'full_name' => 'Almaz Ayana',
            'company' => 'Ayana Holdings',
            'city' => 'Bishoftu',
            'phone' => '+251 95 567 8901',
            'email' => 'almaz@ayana.com',
            'project_type' => 'Hotel / Resort',
            'message' => 'Turnkey outfitting for 30 lakeside guest rooms.',
            'status' => QuoteRequest::STATUS_NEW,
        ]);

        $response = $this->actingAs($admin)->get('/admin/quote-requests');
        $response->assertSuccessful();
        $response->assertSee('Quote Requests');
        $response->assertSee('Almaz Ayana');
        $response->assertSee('Ayana Holdings');
        $response->assertSee('Bishoftu');
    }

    public function test_admin_dashboard_renders_with_quote_request_widgets(): void
    {
        $this->seed(SettingSeeder::class);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@adorn.com',
            'password' => bcrypt('password'),
        ]);

        QuoteRequest::create([
            'full_name' => 'Dawit Tsige',
            'phone' => '+251 96 678 9012',
            'project_type' => 'Private Villa',
            'message' => 'Full villa interior finishing quote requested.',
            'status' => QuoteRequest::STATUS_NEW,
        ]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertSuccessful();
        $response->assertSee('New Inquiries');
        $response->assertSee('Recent Quote Requests from Homepage');
        $response->assertSee('Dawit Tsige');
    }

    public function test_admin_can_view_quote_request_edit_page(): void
    {
        $this->seed(SettingSeeder::class);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@adorn.com',
            'password' => bcrypt('password'),
        ]);

        $quote = QuoteRequest::create([
            'full_name' => 'Sara Daniel',
            'phone' => '+251 91 123 4567',
            'city' => 'Addis Ababa',
            'message' => 'Office furniture quotation request',
            'status' => QuoteRequest::STATUS_NEW,
        ]);

        $response = $this->actingAs($admin)->get("/admin/quote-requests/{$quote->id}/edit");
        $response->assertSuccessful();
        $response->assertSee('Sara Daniel');
        $response->assertSee('Addis Ababa');
    }

    public function test_admin_can_view_quote_request_detail_page(): void
    {
        $this->seed(SettingSeeder::class);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@adorn.com',
            'password' => bcrypt('password'),
        ]);

        $quote = QuoteRequest::create([
            'full_name' => 'Sara Daniel',
            'phone' => '+251 91 123 4567',
            'city' => 'Addis Ababa',
            'message' => 'Office furniture quotation request',
            'status' => QuoteRequest::STATUS_NEW,
        ]);

        $response = $this->actingAs($admin)->get("/admin/quote-requests/{$quote->id}");
        $response->assertSuccessful();
        $response->assertSee('Sara Daniel');
    }

    public function test_admin_can_save_quote_request_changes_via_livewire(): void
    {
        $this->seed(SettingSeeder::class);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@adorn.com',
            'password' => bcrypt('password'),
        ]);

        $quote = QuoteRequest::create([
            'full_name' => 'Sara Daniel',
            'phone' => '+251 91 123 4567',
            'city' => 'Addis Ababa',
            'message' => 'Office furniture quotation request',
            'status' => QuoteRequest::STATUS_NEW,
        ]);

        \Livewire\Livewire::actingAs($admin)
            ->test(\App\Filament\Resources\QuoteRequests\Pages\EditQuoteRequest::class, ['record' => $quote->id])
            ->set('data.status', QuoteRequest::STATUS_IN_PROGRESS)
            ->set('data.admin_notes', 'Followed up via call. Requested floor plan.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('quote_requests', [
            'id' => $quote->id,
            'status' => QuoteRequest::STATUS_IN_PROGRESS,
            'admin_notes' => 'Followed up via call. Requested floor plan.',
        ]);
    }
}
