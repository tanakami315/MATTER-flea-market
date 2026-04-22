<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class UserController extends Controller
{
    public function showProfile()
    {
        return view('mypage.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $user->name = $request->name;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building_name = $request->building_name;

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('user_icon', 'public');
            $user['icon'] = $path;
        }

        $user->save();

        return redirect('/mypage');
    }
}
