<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Like;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'condition',
        'brand',
        'description',
        'price',
        'image',
        'sold',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    #いいね
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    #コメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    #検索
    public function scopeKeywordSearch($query, $keyword)
    {
        if (auth()->check()) {
        $query->where('items.user_id', '!=', auth()->id());
        }

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        return $query;
    }

    #自分が出品した商品を除外
    public function scopeExceptMine($query)
    {
        if (auth()->check()) {
            $query->where('items.user_id', '!=', auth()->id());
        }

        return $query;
    }
}
