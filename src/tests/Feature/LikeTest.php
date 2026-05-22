<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_item()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        $beforeCount = Like::count();

        $response = $this->actingAs($user)
             ->post("/item/{$item->id}/like");

        $response->assertStatus(302);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->assertEquals($beforeCount + 1, Like::count());
    }

    public function test_liked_icon_changes_color()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();


        $this->actingAs($user)
            ->post("/item/{$item->id}/like");

        $response = $this->actingAs($user)
             ->get("/item/{$item->id}");

        $response->assertStatus(200);

        $response->assertSee('heart_pink.png');

    }

    public function test_user_can_remove_like()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        Like::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $beforeCount = Like::count();

        $response = $this->actingAs($user)
            ->delete("/item/{$item->id}/like");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->assertEquals($beforeCount - 1, Like::count());
    }
}