@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_edit.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
@endsection

@section('content')
@if(session('success'))
    <p class="flash-message success">{{ session('success') }}</p>
@endif
<div class="container">
    <div class="edit-ttl">
        <h2>店舗情報更新</h2>
    </div>
    <div class="edit-form">
        <form action="{{ route('manager.update') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">店舗名</label>
                <input type="text" value="{{ $shop->name }}" disabled>
            </div>
            <div class="form-group">
                <label>現在の画像</label><br>
                @if($shop->image_path)
                    <img src="{{ asset($shop->image_path) }}" alt="店舗画像" width="200">
                @else
                    <p>画像未登録</p>
                @endif
            </div>
            <div class="form-group">
                <label>画像を変更</label>
                <input type="file" name="image">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>エリア</label>
                <input type="text" value="{{ $shop->area->name }}" disabled>
            </div>
            <div class="form-group">
                <label>ジャンル</label>
                <input type="text" value="{{ $shop->genre->name }}" disabled>
            </div>
            <div class="form-group">
                <label>説明文</label>
                <textarea name="description" rows="5">{{ old('description', $shop->description) }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="btn">
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection