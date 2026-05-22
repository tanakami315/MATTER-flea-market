<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_edit_form_has_default_values()
    {
        $user = User::factory()->create([
            'name' => 'テスト秀一',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'icon' => 'test-icon.png',
            'profile_completed' => true,
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage/profile');

        $response->assertStatus(200);

        $response->assertSee('value="テスト秀一"', false);

        $response->assertSee('value="123-4567"', false);

        $response->assertSee('value="東京都渋谷区"', false);

        $response->assertSee('test-icon.png');
    }
}