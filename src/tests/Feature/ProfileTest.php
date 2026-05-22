<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Buy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_information_is_displayed()
    {
        $user = User::factory()->create([
            'name' => 'テスト秀一',
            'icon' => 'test-icon.png',
            'profile_completed' => true,
        ]);

        $sellItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品商品',
        ]);

        $buyItem = Item::factory()->create([
            'name' => '購入商品',
            'sold' => true,
        ]);

        Buy::factory()->create([
            'user_id' => $user->id,
            'item_id' => $buyItem->id,
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'building_name' => 'テストマンション',
            'payment_method' => 'card',
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage');

        $response->assertStatus(200);

        $response->assertSee('テスト秀一');

        $response->assertSee('test-icon.png');

        $response = $this->actingAs($user)
            ->get('/mypage?tab=sell');

        $response->assertSee('出品商品');

        $response = $this->actingAs($user)
            ->get('/mypage?tab=buy');

        $response->assertSee('購入商品');
    }
}