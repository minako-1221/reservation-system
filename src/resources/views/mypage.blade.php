@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="reservation">
        <div class="reservation-ttl">
            <h2>予約状況</h2>
            <div class="reservation-toggle">
                <button id="current-btn" class="toggle-btn active">現在の予約</button>
                <button id="past-btn" class="toggle-btn">過去の予約</button>
            </div>
        </div>
        <div id="current-reservations">
            @if($futureReservations->isNotEmpty())
                @foreach($futureReservations as $index => $reservation)
                    <div class="reservation-list">
                        <div class="reservation-list-header">
                            <div class="reservation-list-header-left">
                                <i class="fa fa-clock clock-icon"></i>
                                <h3>予約{{ $index + 1 }}</h3>
                            </div>
                            <div class="reservation-list-header-right">
                                <button class="cancel-btn" data-reservation-id="{{ $reservation->id }}">
                                    <i class="fa fa-times-circle cancel-icon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="info-item">
                            <h3>Shop</h3>
                            <p>{{ $reservation->shop->name }}</p>
                        </div>
                        <div class="info-item">
                            <h3>Date</h3>
                            <p>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('Y-m-d') }}</p>
                        </div>
                        <div class="info-item">
                            <h3>Time</h3>
                            <p>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('H:i') }}</p>
                        </div>
                        <div class="info-item">
                            <h3>Number</h3>
                            <p>{{ $reservation->number_of_people }}人</p>
                        </div>
                        <div class="change-item">
                            <a href="{{ route('reservations.change',$reservation->id) }}" class="change-btn">変更</a>
                        </div>
                    </div>
                @endforeach
            @else
                <p>予約はありません</p>
            @endif
        </div>
        <div id="past-reservations" style="display:none;">
            @if($pastReservations->isNotEmpty())
                @foreach($pastReservations as $index => $reservation)
                    <div class="reservation-list">
                        <div class="reservation-list-header">
                            <div class="reservation-list-header-left">
                                <i class="fa fa-clock clock-icon"></i>
                                <h3>予約{{ $index + 1 }}</h3>
                            </div>
                        </div>
                        <div class="info-item">
                            <h3>Shop</h3>
                            <p>{{ $reservation->shop->name }}</p>
                        </div>
                        <div class="info-item">
                            <h3>Date</h3>
                            <p>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('Y-m-d') }}</p>
                        </div>
                        <div class="info-item">
                            <h3>Time</h3>
                            <p>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('H:i') }}</p>
                        </div>
                        <div class="info-item">
                            <h3>Number</h3>
                            <p>{{ $reservation->number_of_people }}人</p>
                        </div>
                        @if($reservation->review)
                        <div class="review-display">
                            <p class="rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $reservation->review->rating ? 'star-filled' : 'star-empty' }}">★</span>
                                @endfor
                            </p>
                            <p class="review-comment">
                                {{ $reservation->review->comment }}
                            </p>
                        </div>
                        @endif
                        <div class="change-item">
                            @if($reservation->review)
                                <button class="submitted-btn" disabled>投稿済み</button>
                            @else
                                <a href="{{ route('reviews.create',$reservation->id) }}" class="review-btn">レビュー投稿</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p>予約はありません</p>
            @endif
        </div>
        <div id="cancelModal" class="cancel-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-times-circle modal-cancel-icon"></i>
                </div>
                <div class="modal-text">
                    <p>予約をキャンセルします。<br>本当によろしいですか？</p>
                </div>
                <div class="modal-actions">
                    <form id="cancelForm" class="cancel-form" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn-yes">はい</button>
                    </form>
                    <a href="{{ route('mypage') }}" class="btn-no">いいえ</a>
                </div>
            </div>
        </div>
    </div>
    <div class="favorite">
        <div class="user-name">
            <h2>{{ $user_name }}さん</h2>
        </div>
        <div class="favorite-ttl">
            <h3>お気に入り店舗</h3>
        </div>
        <div class="favorite-list">
            @forelse($favoriteShops as $shop)
                <div class="shop-card">
                    <div class="shop-card-image">
                        <img src="{{asset($shop->image_path) }}" alt="Shop Image">
                    </div>
                    <div class="shop-card-text">
                        <div class="shop-card-details">
                            <h3>{{ $shop->name }}</h3>
                            <p>#{{ $shop->area->name }} #{{ $shop->genre->name }}</p>
                        </div>
                        <div class="shop-card-actions">
                            <a href="{{ route('shop.show', $shop->id) }}" class="btn-info">詳しくみる</a>
                            <form action="{{ route('favorites.toggle', $shop->id) }}" method="POST">
                                @csrf
                                @php
                                    $isFavorite = in_array($shop->id, auth()->user()->favorites()->pluck('shop_id')->toArray());
                                @endphp
                                <button type="submit" class="favorite-btn {{ $isFavorite ? 'active' : '' }}"
                                    data-favorite="{{ $isFavorite ? 'true' : 'false' }}">
                                    <i class="fa fa-heart {{ $isFavorite ? 'favorited' : '' }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>お気に入りがありません。</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/mypage.js') }}"></script>
@endsection