@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth__content--thanks">
    <div class="thanks__message">
        <span>会員登録ありがとうございます</span>
    </div>
    <div class="thanks__button">
        <a href="{{ route('login') }}" class="form__button-submit">ログインする</a>
    </div>
</div>
@endsection