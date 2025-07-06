@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="verify-container">
    <h2>メールアドレス確認</h2>
    <p>ご登録のメールアドレス宛に確認リンクを送信しました。</p>
    <p>メールが届いていない場合は、以下のボタンから再送信してください。</p>

    @if (session('message'))
        <p class="success-message">{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="resend-button">確認メールを再送信</button>
    </form>
</div>
@endsection
