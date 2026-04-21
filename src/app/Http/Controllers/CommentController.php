<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        $comment = $request->only([
            'comment'
        ]);
        Comment::create(array_merge($comment, ['item_id' => $item_id, 'user_id' => $user->id]));
        return redirect("item/{$item_id}");
    }

    public function showComments($item_id)
    {
        $item = Item::findOrFail($item_id);
        $comments = Comment::where('item_id', $item_id)->get();
        return view('purchase.detail', compact('item', 'comments'));
    }
}
