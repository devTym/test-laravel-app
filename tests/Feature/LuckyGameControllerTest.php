<?php

namespace Tests\Feature;

use App\Models\UserLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LuckyGameControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_play_game_returns_valid_response()
    {
        $userLink = UserLink::factory()->create();

        $response = $this->post(route('userLink.lucky.play', $userLink->token));
        $response->assertStatus(302);
        $response->assertRedirect(route('userLink.show', ['token' => $userLink->token]));
        $response->assertSessionHas('lucky');

        $lucky = session('lucky');
        $this->assertArrayHasKey('random', $lucky);
        $this->assertArrayHasKey('result', $lucky);
        $this->assertArrayHasKey('winSum', $lucky);
    }
}
