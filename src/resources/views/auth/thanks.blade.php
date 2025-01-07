@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth__content">
    <div class="thanks__message">
        <span>会員登録ありがとうございます</span>
    </div>
    <div class="thanks__button">
        <button class="form__button-submit" type="submit">ログインする</button>
    </div>
</div>
@endsection