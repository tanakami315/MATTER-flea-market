<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MylistTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_like_is_displayed()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $likedItem = Item::factory()->create([
            'name' => 'いいねした商品',
        ]);

        $notLikedItem = Item::factory()->create([
            'name' => 'その他の商品',
        ]);

        Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $likedItem->id,
        ]);
    
        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertStatus(200);

        $response->assertSee('いいねした商品');

        $response->assertDontSee('その他の商品');
    }

    public function test_sold_like_displays_sold_label()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $liked_soldItem = Item::factory()->create([
            'name' => 'いいねした購入済み商品',
            'sold' => true,
        ]);

        Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $liked_soldItem->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    public function test_guest_cannot_see_any_items()
    {
        $user = User::factory()->create();

        $likedItem = Item::factory()->create([
            'name' => 'いいねした商品',
        ]);
        
        Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $likedItem->id,
        ]);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);

        $response->assertDontSee('いいねした商品');
    }
    }