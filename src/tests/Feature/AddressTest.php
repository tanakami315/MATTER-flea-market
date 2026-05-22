<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_changed_address_is_displayed()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        $this->actingAs($user)
            ->post("/purchase/address/{$item->id}", [
                'postal_code' => '987-6543',
                'address' => '大阪府大阪市',
                'building_name' => '大阪マンション',
            ]);

        $response = $this->actingAs($user)
            ->get("/purchase/{$item->id}");

        $response->assertStatus(200);

        $response->assertSee('987-6543');
        $response->assertSee('大阪府大阪市');
        $response->assertSee('大阪マンション');
    }

        public function test_purchase_is_saved_with_changed_address()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        $this->actingAs($user)
            ->post("/purchase/address/{$item->id}", [
                'postal_code' => '987-6543',
                'address' => '大阪府大阪市',
                'building_name' => '大阪マンション',
            ]);

        $this->actingAs($user)
            ->post("/purchase/finish/{$item->id}", [
                'postal_code' => '987-6543',
                'address' => '大阪府大阪市',
                'building_name' => '大阪マンション',
                'payment_method' => 'card',
            ]);

        $this->actingAs($user)
            ->get("/purchase/success/{$item->id}");

        $this->assertDatabaseHas('buys', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => '987-6543',
            'address' => '大阪府大阪市',
            'building_name' => '大阪マンション',
        ]);
    }
}