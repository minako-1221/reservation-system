@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="reservation">
            <div class="reservation-ttl">
                <h2>予約状況</h2>
            </div>
            @foreach($reservations as $index => $reservation)
                <div class="reservation-list">
                    @if(isset($reservations) && $reservations->isNotEmpty())
                        <div class="reservation-list-header">
                            <div class="reservation-list-header-left">
                                <i class="fa fa-clock clock-icon"></i>
                                <h3>予約{{ $index + 1 }}</h3>
                            </div>
                            <div class="reservation-list-header-right">
                                <i class="fa fa-times-circle cancel-icon"></i>
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
                    @else
                        <p>予約はありません</p>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="favorite">
            <div class="user-name">
                <h2>{{ $user_name }}さん</h2>
            </div>
            <div class="favorite-ttl">
                <h3>お気に入り店舗</h3>
            </div>
            <div class="favorite-list">
                @if(isset($favorites) && $favorites->isNotEmpty())
                    @foreach ($favorites as $favorite)
                        @php $shop = $favorite->shop; @endphp
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
                                        @php $isFavorite = in_array($shop->id,$favoriteShops ?? []); @endphp
                                        <button type="submit"
                                            class="favorite-btn {{ $isFavorite ? 'active' : '' }}"
                                            data-favorite="{{ $isFavorite ? 'true' : 'false' }}">
                                            <i class="fa fa-heart {{ $isFavorite ? 'favorited' : '' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <p>お気に入りがありません。</p>
                @endif
            </div>
        </div>
    </div>


@endsection