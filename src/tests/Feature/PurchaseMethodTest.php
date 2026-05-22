<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_method_is_displayed()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post("/purchase/finish/{$item->id}", [
                'postal_code' => '123-4567',
                'address' => '東京都渋谷区',
                'building_name' => 'テストマンション',
                'payment_method' => 'konbini',
            ]);

        $response->assertStatus(302);

        $response = $this->actingAs($user)
            ->get("/purchase/{$item->id}");

        $response->assertStatus(200);

        $response->assertSee('コンビニ払い');
    }
}