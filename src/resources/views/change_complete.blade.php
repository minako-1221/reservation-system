@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="done__message">
        <span>予約の変更が完了しました。</span>
    </div>
    <div class="return__button">
        <a href="{{ route('mypage')}}" class="return__button-submit">戻る</a>
    </div>
</div>
@endsection