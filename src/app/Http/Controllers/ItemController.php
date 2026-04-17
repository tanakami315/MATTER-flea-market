<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::all();
        return view('index', compact('items'));
    }
    
    public function sell()
    {
        $categories = Category::all();
        return view('sell',compact('categories'));
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

    public function mypage()
    {
        return view('mypage');
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->update($request->only(['name','postal_code', 'address', 'building_name', 'icon']));
        $user->profile_completed = true;
        $user->save();

        return redirect('/');
    }
}


