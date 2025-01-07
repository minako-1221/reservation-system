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
    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(RegisterRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('thanks');
    }

    public function getThanks()
    {
        return view('thanks');
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])){
            return redirect('/');
        }else{
            return redirect('login')->with('result','メールアドレスまたはパスワードが間違っています');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('login');
    }
}
