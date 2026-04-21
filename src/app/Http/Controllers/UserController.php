<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class UserController extends Controller
{
    public function showMypage()
    {
        return view('mypage.mypage');
    }

    public function showProfile()
    {
        return view('mypage.profile');
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
