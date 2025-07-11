<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->route('thanks');
    }

    public function getThanks()
    {
        return view('auth.thanks');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();

            if(!$user->hasVerifiedEmail()){
                return redirect()->route('verification.notice');
            }

            if($user->role === 1){
                return redirect()->route('admin.dashboard');
            }elseif($user->role === 2){
                return redirect()->route('manager.dashboard', $user->shop_id);
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')->with('failed','メールアドレスまたはパスワードが間違っています');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
