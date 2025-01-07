@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
@if(session('result'))
<div class="flash-message">
    {{session('result')}}
</div>
@endif
<div class="auth__content">
    <div class="auth-form__heading">
        <h2>Login</h2>
    </div>
    <form action="/login" class="form" method="POST">
        @csrf
        <div class="form-group">
            <i class="icon email-icon"></i>
            <input type="email" name="email" placeholder="Email" value="{{old('email')}}" />
        </div>
        <div class="form__error">
            @error('email')
                {{$message}}
            @enderror
        </div>
        <div class="form-group">
            <i class="icon password-icon"></i>
            <input type="password" name="password" placeholder="Password" value="{{old('password')}}" />
        </div>
        <div class="form__error">
            @error('password')
                {{$message}}
            @enderror
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection