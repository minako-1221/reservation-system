@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="detail">
        <div class="detail-ttl">
            <a href="/"></a>
            <h2></h2>
        </div>
        <div class="detail-img">
            <img src="" alt="">
        </div>
        <div class="detail-hush">
            <p></p>
        </div>
        <div class="detail-text"></div>
    </div>
    <div class="reservation">
        <div class="reservation-ttl">
            <h3>予約</h3>
        </div>
        <div class="reservation-date"></div>
        <div class="reservation-time"></div>
        <div class="reservation-number"></div>
        <div class="reservation-details">
            <div class="info-shop">
                <h3>Shop</h3>
                <p>{{ $reservation->shop->name }}</p>
            </div>
            <div class="info-date">
                <h3>Date</h3>
                <p>{{ \Carbon\Carbon::parse($reservation->reservation_datetaime)->format('Y-m-d') }}</p>
            </div>
            <div class="info-time">
                <h3>Time</h3>
                <p>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('H:i') }}</p>
            </div>
            <div class="info-number">
                <h3>Number</h3>
                <p>{{ $reservation->number_of_people }}人</p>
            </div>
        </div>
        <div class="reservation-btn">
            <button>予約する</button>
        </div>
    </div>

@endsection