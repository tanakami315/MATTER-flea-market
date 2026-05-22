<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_comment()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        $beforeCount = Comment::count();

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => 'テストコメント',
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);

        $this->assertEquals($beforeCount + 1, Comment::count());
    }

    public function test_guest_cannot_comment()
    {
        $item = Item::factory()->create();

        $response = $this->post("/item/{$item->id}/comment", [
            'comment' => 'ゲストコメント',
        ]);

        $this->assertDatabaseMissing('comments', [
            'comment' => 'ゲストコメント',
        ]);
    }

    public function test_comment_is_required()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => '',
            ]);

        $response->assertSessionHasErrors([
            'comment' => 'コメントを入力してください'
        ]);
    }

    public function test_comment_must_be_within_255_characters()
    {
        $user = User::factory()->create([
            'profile_completed' => true,
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => 
                    '購入を検討しているのですが、いくつか確認させてください。
                    商品説明では状態は良好とのことでしたが、実際の使用期間はどのくらいでしょうか。
                    また、目立つ傷や汚れはないとのことですが、細かな擦れや色落ちなどはありますか。
                    写真ではとても綺麗に見えますが、実物に近い状態を詳しく知りたいです。
                    付属品についても確認したく、購入時についていた箱や説明書などは一緒に発送していただけますでしょうか。
                    さらに、発送方法についてですが、できれば追跡可能な方法でお願いしたいと考えています。
                    最後に、もし可能であれば別角度からの写真を追加していただけると大変助かります。
                    高額な買い物なので慎重に検討したいと思っております。よろしくお願いいたします。'
            ]);

        $response->assertSessionHasErrors([
            'comment' => 'コメントは255文字以内で入力してください'
        ]);
    }
}