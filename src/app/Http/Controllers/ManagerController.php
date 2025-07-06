<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $reservations = Reservation::where('shop_id', $user->shop_id)
            ->orderBy('reservation_datetime', 'asc')
            ->get();

        return view('manager.dashboard',compact('reservations'));
    }

    public function edit()
    {
        $user = Auth::user();
        $shop = Shop::findOrFail($user->shop_id);

        return view('manager.shop_edit',compact('shop'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $shop = Shop::findOrFail($user->shop_id);

        $shop->description = $request->description;

        if($request->hasFile('image')){
            if($shop->image_path && Storage::exists($shop->image_path)){
                Storage::delete($shop->image_path);
            }

            $path = $request->file('image')->store('public/images');
            $shop->image_path = str_replace('public/', 'storage/', $path);
        }

        $shop->save();

        return redirect()->route('manager.edit')->with('success', '店舗情報を更新しました');
    }
}
