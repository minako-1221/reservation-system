@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

@endsection

@section('header-right')
    <form action="{{ route('search') }}" method="GET" class="search-form">
        <div class="search-item">
            <select name="area" class="search-select">
                <option value="">All area</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="search-item">
            <select name="genre" class="search-select">
                <option value="">All genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="search-input-wrapper search-item">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
            <input type="text" name="keyword" placeholder="Search ..." class="search-input"
                value="{{ request('keyword') }}">
        </div>
    </form>
@endsection


@section('content')

    @if($shops->isEmpty())
        <p class="no-results">該当する店舗がありません</p>
    @else
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
                            @auth
                                <form action="{{ route('favorites.toggle', $shop->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="favorite-btn {{ in_array($shop->id, $favoriteShops ?? []) ? 'active' : '' }}"
                                        data-favorite="{{ in_array($shop->id, $favoriteShops ?? []) ? 'true' : 'false' }}">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection