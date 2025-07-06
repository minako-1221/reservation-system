<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $shops = Shop::all();
        return view('admin.dashboard',compact('shops'));
    }

    public function createManager(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'shop_id' => 'required|exists:shops,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
            'shop_id' => $request->shop_id,
        ]);

        return redirect()->route('admin.dashboard')->with('success','登録完了しました');
    }
}
