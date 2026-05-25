<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_item_detail_is_displayed()
    {
        $seller = User::factory()->create([
            'name' => '出品トオル',
        ]);

        $commenter = User::factory()->create([
            'name' => 'コメント美子',
            'icon' => 'commenter_icon.jpg',
        ]);

        $item = Item::factory()->create([
            'user_id' => $seller->id,
            'name' => '白い帽子',
            'condition' => 1,
            'brand' => 'NEWARE',
            'description' => '商品説明',
            'price' => 3000,
            'image' => 'whitecap.jpg',
            'sold' => false,
        ]);

        $category = Category::factory()->create([
            'content' => 'ファッション',
        ]);

        $item->categories()->attach($category->id);

        Like::factory()->count(2)->create([
            'item_id' => $item->id,
        ]);

        Comment::factory()->count(3)->create([
            'item_id' => $item->id,
        ]);

        Comment::factory()->create([
            'user_id' => $commenter->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertStatus(200);

        $response->assertSee('白い帽子');
        $response->assertSee('NEWARE');
        $response->assertSee('3,000');
        $response->assertSee('商品説明');
        $response->assertSee('ファッション');
        $response->assertSee('良好');
        $response->assertSee('whitecap.jpg');


        $response->assertSee('2');
        $response->assertSee('コメント(4)');
        $response->assertSee('コメント美子');
        $response->assertSee('commenter_icon.jpg');
        $response->assertSee('テストコメント');
    }

    public function test_multiple_categories_are_displayed()
    {
        $item = Item::factory()->create();

        $category1 = Category::factory()->create([
            'content' => 'ファッション',
        ]);

        $category2 = Category::factory()->create([
            'content' => 'メンズ',
        ]);

        $item->categories()->attach([
            $category1->id,
            $category2->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertStatus(200);

        $response->assertSee('ファッション');
        $response->assertSee('メンズ');
    }
}