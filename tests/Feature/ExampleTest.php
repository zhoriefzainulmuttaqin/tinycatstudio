<?php

namespace Tests\Feature;

use App\Models\Service;
use Database\Seeders\TinyCatStudioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_homepage_returns_a_successful_response(): void
    {
        $this->seed(TinyCatStudioSeeder::class);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('TinyCatStudio')
            ->assertSee('Website Development');
    }

    public function test_a_lead_can_be_submitted(): void
    {
        $this->seed(TinyCatStudioSeeder::class);

        $service = Service::query()->firstOrFail();

        $response = $this->from('/')->post(route('leads.store'), [
            'name' => 'Calon Klien',
            'email' => 'client@example.com',
            'phone' => '08123456789',
            'service_id' => $service->id,
            'budget' => 'Rp 10.000.000',
            'message' => 'Saya butuh website company profile.',
        ]);

        $response
            ->assertSessionHasNoErrors('lead')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('leads', [
            'email' => 'client@example.com',
            'service_id' => $service->id,
            'status' => 'new',
        ]);
    }
}
