<?php

namespace Tests\Feature;

use App\Models\TeamMember;
use Database\Seeders\ContentSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_index_page_returns_successful_response(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/team');

        $response->assertSuccessful();
        $response->assertSee('Adorn Trading PLC');
        $response->assertSee('Local leadership with global execution.');
        $response->assertDontSee('MIRADEN', false);
    }

    public function test_team_index_displays_full_active_team_roster_with_details(): void
    {
        $this->seed(SettingSeeder::class);
        $this->seed(ContentSeeder::class);

        $response = $this->get('/team');

        $response->assertSuccessful();

        $activeMembers = TeamMember::where('is_active', true)->get();
        $this->assertCount(5, $activeMembers);

        foreach ($activeMembers as $member) {
            $response->assertSee($member->name);
            $response->assertSee($member->role);
            $response->assertSee($member->bio);

            if ($member->email) {
                $response->assertSee('mailto:' . $member->email, false);
            }

            if ($member->linkedin_url) {
                $response->assertSee($member->linkedin_url, false);
            }
        }
    }

    public function test_team_index_omits_inactive_members(): void
    {
        $this->seed(SettingSeeder::class);

        $active = TeamMember::create([
            'name' => 'Active Officer',
            'role' => 'Project Lead',
            'bio' => 'Active team member profile.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $inactive = TeamMember::create([
            'name' => 'Inactive Former Staff',
            'role' => 'Old Role',
            'bio' => 'Should never appear in the team roster.',
            'sort_order' => 2,
            'is_active' => false,
        ]);

        $response = $this->get('/team');

        $response->assertSuccessful();
        $response->assertSee('Active Officer');
        $response->assertDontSee('Inactive Former Staff');
    }

    public function test_team_index_renders_member_with_uploaded_photo(): void
    {
        $this->seed(SettingSeeder::class);

        $memberWithPhoto = TeamMember::create([
            'name' => 'Kidus Tesfaye',
            'role' => 'Senior Site Engineer',
            'bio' => 'Oversees turnkey site execution and precision joinery installation.',
            'photo' => 'team-photos/kidus.jpg',
            'email' => 'kidus@adorntrading.com',
            'linkedin_url' => 'https://linkedin.com/in/kidus',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/team');

        $response->assertSuccessful();
        $response->assertSee('Kidus Tesfaye');
        $response->assertSee('team-photos/kidus.jpg');
        $response->assertSee('mailto:kidus@adorntrading.com', false);
        $response->assertSee('https://linkedin.com/in/kidus', false);
    }
}
