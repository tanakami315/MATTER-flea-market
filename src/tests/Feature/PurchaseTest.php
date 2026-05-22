<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Buy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_purchase_item()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create([
            'sold' => false,
        ]);

        $this->actingAs($user)
            ->post("/purchase/finish/{$item->id}", [
                'postal_code' => '123-4567',
                'address' => '東京都渋谷区',
                'building_name' => 'テストマンション',
                'payment_method' => 'card',
        ]);

        $response = $this->actingAs($user)
            ->get("/purchase/success/{$item->id}");


        $response->assertStatus(302);

        $this->assertDatabaseHas('buys', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_purchased_item_displays_sold_label()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create([
            'name' => 'テスト商品',
            'sold' => true,
        ]);

        Buy::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Sold');
    }

    public function test_purchased_item_is_displayed_in_profile()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create([
            'name' => '購入済み商品',
            'sold' => true,
        ]);

        Buy::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage?tab=buy');

        $response->assertStatus(200);

        $response->assertSee('購入済み商品');
    }
}