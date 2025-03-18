@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="done__message">
        <span>ご予約ありがとうございます</span>
    </div>
    <div class="return__button">
        <a href="{{ route('shop.show',['shop_id'=>$shop_id]) }}" class="return__button-submit">戻る</a>
    </div>
</div>
@endsection