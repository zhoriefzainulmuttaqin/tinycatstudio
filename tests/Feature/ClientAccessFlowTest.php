<?php

namespace Tests\Feature;

use App\Mail\ClientActivationOtp;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ClientAccessFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_login_page_is_accessible_on_invoice_domain(): void
    {
        $response = $this->onClientDomain()->get(route('filament.client.auth.login'));

        $response->assertOk();
    }

    public function test_unverified_client_is_redirected_to_otp_before_accessing_dashboard(): void
    {
        $client = $this->createClient([
            'email_verified_at' => null,
            'activation_otp' => '123456',
            'activation_otp_expires_at' => now()->addMinutes(15),
        ]);

        $response = $this->onClientDomain()
            ->actingAs($client, 'client')
            ->get(route('filament.client.pages.dashboard'));

        $response->assertRedirect(route('client.verify-otp.show'));
    }

    public function test_client_can_activate_account_with_a_valid_otp(): void
    {
        $client = $this->createClient([
            'email_verified_at' => null,
            'activation_otp' => '123456',
            'activation_otp_expires_at' => now()->addMinutes(15),
        ]);

        $response = $this->onClientDomain()
            ->actingAs($client, 'client')
            ->post(route('client.verify-otp.verify'), [
                'otp' => '123456',
            ]);

        $response->assertRedirect(route('filament.client.pages.dashboard'));

        $this->assertNotNull($client->fresh()->email_verified_at);
        $this->assertNull($client->fresh()->activation_otp);
    }

    public function test_unverified_client_can_request_a_new_otp_via_email(): void
    {
        Mail::fake();

        $client = $this->createClient([
            'email_verified_at' => null,
            'activation_otp' => '123456',
            'activation_otp_expires_at' => now()->addMinutes(15),
        ]);

        $response = $this->onClientDomain()
            ->actingAs($client, 'client')
            ->from(route('client.verify-otp.show'))
            ->post(route('client.verify-otp.resend'));

        $response
            ->assertRedirect(route('client.verify-otp.show'))
            ->assertSessionHas('status', 'Kode OTP baru sudah dikirim ke email Anda.');

        $client->refresh();

        $this->assertNotSame('123456', $client->activation_otp);
        $this->assertTrue($client->activation_otp_expires_at->isFuture());

        Mail::assertSent(ClientActivationOtp::class, function (ClientActivationOtp $mail) use ($client) {
            return $mail->hasTo($client->email) && $mail->otp === $client->activation_otp;
        });
    }

    private function onClientDomain(): self
    {
        return $this->withServerVariables([
            'HTTP_HOST' => 'invoice.tinycatstudio.tech',
        ]);
    }

    private function createClient(array $attributes = []): Client
    {
        return Client::create(array_merge([
            'name' => 'Client Test',
            'company_name' => 'TinyCat Client',
            'email' => 'client@example.com',
            'password' => 'password123',
            'phone' => '08123456789',
            'address' => 'Jl. Testing No. 1',
            'is_active' => true,
            'valid_until' => now()->addMonth()->toDateString(),
        ], $attributes));
    }
}
