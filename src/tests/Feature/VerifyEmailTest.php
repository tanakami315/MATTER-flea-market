<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerifyEmailTest extends \Tests\TestCase
{
    use RefreshDatabase;
    
    public function test_user_is_created_as_unverified_after_register()
    {
        $this->post('/register', [
            'name' => 'テスト秀一',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'email_verified_at' => null,
        ]);
    }

    public function test_verification_button_has_mailhog_link()
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)
            ->get('/email/verify');
        
        $response->assertStatus(200);

        $response->assertSee('認証はこちらから');
        
        $response->assertSee('http://localhost:8025', false);
    }

    public function test_verified_user_redirects_to_profile_page()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'profile_completed' => false,
        ]);

        $response = $this->actingAs($user)
            ->get('/redirect-after-login');

        $response->assertRedirect('/mypage/profile');
    }
}