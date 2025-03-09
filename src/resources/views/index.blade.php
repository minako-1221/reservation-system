@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header-right')
    <form action="{{ route('search') }}" method="GET" class="search-form">
        <div class="search-item">
            <select name="area" class="search-select">
                <option value="">All area</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-item">
            <select name="genre" class="search-select">
                <option value="">All genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-input-wrapper search-item">
            <input type="text" name="shop_name" placeholder="Search ..." class="search-input">
        </div>
    </form>
@endsection


@section('content')
    <div class="shop-list">
        @foreach ($shops as $shop)
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
                            <button type="submit" class="favorite-btn {{ in_array($shop->id, $favoriteShops ?? []) ? 'active' : '' }}" data-favorite="{{ in_array($shop->id, $favoriteShops ?? []) ? 'true' : 'false' }}">
                                <i class="fa fa-heart"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection