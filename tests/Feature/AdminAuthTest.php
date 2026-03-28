<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_admin_login_page_is_accessible_via_masuk_kucing(): void
    {
        $response = $this->get('/masuk-kucing');

        $response
            ->assertOk()
            ->assertSee('Masuk Admin')
            ->assertSee('/masuk-kucing');
    }

    public function test_an_admin_can_log_in_from_the_custom_url(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $response = $this->post('/masuk-kucing', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_a_non_admin_user_cannot_log_in_from_the_custom_url(): void
    {
        User::factory()->create([
            'email' => 'staff@example.com',
            'password' => 'password',
            'role' => 'staff',
        ]);

        $response = $this->from('/masuk-kucing')->post('/masuk-kucing', [
            'email' => 'staff@example.com',
            'password' => 'password',
        ]);

        $response
            ->assertRedirect('/masuk-kucing')
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_guests_are_redirected_to_the_custom_login_page_when_accessing_the_dashboard(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('login'));
    }
}
