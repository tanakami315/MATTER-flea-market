<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_all_items_are_displayed()
    {
        $items = Item::factory()->count(10)->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        foreach ($items as $item) {
            $response->assertSee($item->name);
        }
    }

    public function test_sold_item_displays_sold_label()
    {
        Item::factory()->create([
            'name' => '購入済み商品',
            'sold' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    public function test_my_item_is_not_displayed()
    {
        $user = User::factory()->create();

        $myItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品した商品',
        ]);

        $otherItem = Item::factory()->create([
            'name' => 'その他商品',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('出品した商品');
        $response->assertSee('その他商品');
    }
}