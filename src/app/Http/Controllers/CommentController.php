<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Item;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        $comment = $request->only([
            'comment'
        ]);
        Comment::create(array_merge($comment, ['item_id' => $item_id, 'user_id' => $user->id]));
        return redirect("item/{$item_id}");
    }
}