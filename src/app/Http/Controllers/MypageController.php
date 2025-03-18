<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class MypageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->get();

        return view('mypage',[
            'user_name'=>$user->name,
            'favorites'=>$favorites,
        ]);
    }
}
