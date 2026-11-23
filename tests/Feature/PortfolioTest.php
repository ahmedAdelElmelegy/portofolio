<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use App\Models\VideoSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_portfolio_home_page_renders_successfully(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Ahmed Adel');
        $response->assertSee('Flutter Developer');
        $response->assertSee('Circle');
    }

    public function test_public_project_detail_page_renders(): void
    {
        $project = Project::where('slug', 'circle')->firstOrFail();

        $response = $this->get(route('projects.show', $project->slug));

        $response->assertStatus(200);
        $response->assertSee($project->name);
        $response->assertSee('Core Application Features');
    }

    public function test_contact_form_submission_stores_message(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Recruiter Name',
            'email' => 'recruiter@example.com',
            'subject' => 'Job Offer',
            'message' => 'We love your portfolio and would like to discuss an opportunity.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'recruiter@example.com',
        ]);
    }

    public function test_admin_login_page_renders(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertSee('Admin Portal');
    }

    public function test_guest_accessing_admin_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_dashboard_accessible_when_authenticated(): void
    {
        $user = User::where('email', 'admin@portfolio.test')->first();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Total Projects');
    }

    public function test_api_projects_endpoint_returns_json(): void
    {
        $response = $this->getJson('/api/projects');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => ['id', 'name', 'slug', 'technologies', 'features'],
            ],
        ]);
    }

    public function test_api_skills_endpoint_returns_json(): void
    {
        $response = $this->getJson('/api/skills');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data',
        ]);
    }

    public function test_api_work_processes_endpoint_returns_json(): void
    {
        $response = $this->getJson('/api/work-processes');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => ['id', 'title', 'description', 'sort_order'],
            ],
        ]);
    }

    public function test_public_portfolio_renders_video_showcase_section(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Interactive Showcase');
        $response->assertSee('ahmedadelelmelegy2@gmail.com');
        $response->assertSee('LinkedIn Profile');
    }

    public function test_admin_can_view_video_section_management(): void
    {
        $user = User::where('email', 'admin@portfolio.test')->first();

        $response = $this->actingAs($user)->get(route('admin.video-section.edit'));

        $response->assertStatus(200);
        $response->assertSee('Video Showcase');
        $response->assertSee('Interactive Content Cards');
    }

    public function test_admin_can_update_video_section_and_items(): void
    {
        $user = User::where('email', 'admin@portfolio.test')->first();

        $response = $this->actingAs($user)->put(route('admin.video-section.update'), [
            'badge' => 'Exclusive Bio',
            'title' => 'Updated Interactive Intro',
            'subtitle' => 'Check out my latest video presentation.',
            'is_active' => '1',
            'items' => [
                [
                    'title' => 'My Telegram',
                    'value' => '@ahmedadel',
                    'url' => 'https://t.me/ahmedadel',
                    'icon' => 'fa-brands fa-telegram',
                    'badge' => 'Fastest Reply',
                    'sort_order' => 1,
                ],
            ],
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('video_sections', [
            'title' => 'Updated Interactive Intro',
            'badge' => 'Exclusive Bio',
        ]);
        $this->assertDatabaseHas('video_content_items', [
            'title' => 'My Telegram',
            'value' => '@ahmedadel',
        ]);
    }

    public function test_admin_can_upload_and_replace_video_file(): void
    {
        Storage::fake('public');
        $user = User::where('email', 'admin@portfolio.test')->first();

        $videoFile = UploadedFile::fake()->create('custom_intro.mp4', 8000, 'video/mp4');

        $response = $this->actingAs($user)->put(route('admin.video-section.update'), [
            'title' => 'Video Title Tested',
            'video' => $videoFile,
            'is_active' => '1',
        ]);

        $response->assertSessionHas('success');

        $videoSection = VideoSection::first();
        $this->assertNotNull($videoSection->video_path);
        $this->assertStringStartsWith('videos/', $videoSection->video_path);
        Storage::disk('public')->assertExists($videoSection->video_path);
    }
}
