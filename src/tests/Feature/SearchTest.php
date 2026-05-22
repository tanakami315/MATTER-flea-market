<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

   public function test_items_can_be_searched()
    {
        Item::factory()->create([
            'name' => '白い帽子',
        ]);

        Item::factory()->create([
            'name' => '黒縁眼鏡',
        ]);

        $response = $this->get('/search?keyword=帽子');

        $response->assertStatus(200);

        $response->assertSee('白い帽子');

        $response->assertDontSee('黒縁眼鏡');
    }

    public function test_search_keyword_is_kept_in_mylist()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/?tab=mylist&keyword=帽子');

        $response->assertStatus(200);

        $response->assertSee('value="帽子"', false);
    }
}