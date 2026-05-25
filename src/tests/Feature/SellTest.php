<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SellTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_sell_item()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $category = Category::factory()->create([
            'content' => 'ファッション',
        ]);

        $image = UploadedFile::fake()->create('test.jpeg', 100, 'image/jpeg');

        $response = $this->actingAs($user)
            ->post('/sell', [
                'category_id' => [$category->id],
                'condition' => 1,
                'name' => '白い帽子',
                'brand' => 'NEWARE',
                'description' => 'テスト商品の説明',
                'price' => 5000,
                'image' => $image,
            ]);
        
        $response->assertStatus(302);

        $this->assertDatabaseHas('items', [
            'user_id' => $user->id,
            'name' => '白い帽子',
            'brand' => 'NEWARE',
            'description' => 'テスト商品の説明',
            'price' => 5000,
            'condition' => 1,
        ]);

        $item = \App\Models\Item::first();

        $this->assertNotEmpty($item->image);
    }
}