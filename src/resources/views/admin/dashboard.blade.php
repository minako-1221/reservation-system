@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
@if (session('success'))
    <div class="flash-message success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="flash-message error">
        {{ session('error') }}
    </div>
@endif

<div class="auth__content">
    <div class="auth-form__heading">
        <h2>店舗管理者登録</h2>
    </div>
    <form action="{{ route('admin.createManager') }}" class="form" method="POST">
        @csrf
        <div class="form-group">
            <i class="icon user-icon"></i>
            <input type="text" name="name" placeholder="Username" value="{{old('name')}}" />
        </div>
        <div class="form__error">
            @error('name')
                {{$message}}
            @enderror
        </div>
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
            <input type="password" name="password" placeholder="Password" />
        </div>
        <div class="form__error">
            @error('password')
                {{$message}}
            @enderror
        </div>
        <div class="form-group">
            <i class="icon shop-icon"></i>
            <select name="shop_id" required>
                <option value="" disabled selected>店舗を選択してください</option>
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection