<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Buy;
use App\Models\Like;

class ItemController extends Controller
{
    #一覧表示
    public function index(Request $request)
    {
        $tab = $request->query('tab');

        if ($tab === 'mylist') {
            $items = Item::join('likes', 'items.id', '=', 'likes.item_id')
                ->where('likes.user_id', auth()->id())
                ->orderBy('likes.id', 'desc')
                ->select('items.*')
                ->get();
        } else {
            $items = Item::orderBy('id', 'desc')->get();
        }
        return view('index', compact('items'));
    }
    
    #出品
    public function sell()
    {
        $categories = Category::all();
        return view('sell.sell',compact('categories'));
    }

    public function store(Request $request)
    {
        $item = $request->only([ 
            'category_id',
            'name',
            'condition',
            'brand',
            'description',
            'price',
            'image',
            'sold',
        ]);

        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('item-images', 'public');
        $item['image'] = $path;
        }

        Item::create($item);
        return redirect('/');
    }

    #購入
    public function showDetail($item_id)
    {
        $item = Item::findOrFail($item_id);
        $category = Category::findOrFail($item->category_id);
        return view('purchase.detail', compact('item','category'));
    }

    public function choose(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        $purchaseAddress = session('purchase_address', [
            'postal_code' => $user->postal_code,
            'address' => $user->address,
            'building_name' => $user->building_name,
        ]);

        return view('purchase.purchase', compact('item', 'user', 'purchaseAddress'));
    }

    public function editAddress(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        $purchaseAddress = session('purchase_address', [
            'postal_code' => $user->postal_code,
            'address' => $user->address,
            'building_name' => $user->building_name,
        ]);

        return view('purchase.edit-address', compact('item','user', 'purchaseAddress'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        $request->validate([
            'postal_code' => ['required'],
            'address' => ['required'],
            'building_name' => ['nullable'],
    ]);

        session([
            'purchase_address' => [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building_name' => $request->building_name,
        ]
    ]);

        return redirect("/purchase/{$item_id}");
    }

    public function purchase(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        $purchaseAddress = session('purchase_address');

        $buy = [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'postal_code' => $purchaseAddress['postal_code'] ?? $user->postal_code,
            'address' => $purchaseAddress['address'] ?? $user->address,
            'building_name' => $purchaseAddress['building_name'] ?? $user->building_name,
            'payment_method' => $request->payment_method,
        ];

        $item->sold = true;
        $item->save();

        Buy::create($buy);
        return redirect("/");
    }

    #いいね
    public function like($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        Like::firstOrCreate(array_merge(['item_id' => $item_id, 'user_id' => $user->id]));
        return redirect("/item/{$item_id}");
    }

    public function unlike($item_id)
    {
        Like::where('item_id', $item_id)->where('user_id', auth()->id())->delete();
        return redirect("/item/{$item_id}");
    }
}

