<?php

namespace Tests\Feature;

use App\Models\UserLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLinkControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Register');
    }

    public function test_register()
    {
        $data = [
            'username' => 'John Doe',
            'phonenumber' => '1234567890',
        ];

        $response = $this->post(route('userLink.register'), $data);

        $userLink = UserLink::latest()->first();
        $response->assertRedirect(route('userLink.show', ['token' => $userLink->token]));
        $response->assertSessionHas('message');

        $this->assertDatabaseHas('user_links', [
            'username' => $data['username'],
            'phonenumber' => $data['phonenumber'],
            'token' => $userLink->token,
        ]);
    }

    public function test_deactivate_user_link()
    {
        $userLink = UserLink::factory()->create();

        $response = $this->post(route('userLink.deactivate', ['token' => $userLink->token]));
        $response->assertRedirect('/');

        $userLink->refresh();
        $expiresAt = \Carbon\Carbon::parse($userLink->token_expires_at);

        $this->assertTrue($expiresAt->lt(now()));
    }
}
