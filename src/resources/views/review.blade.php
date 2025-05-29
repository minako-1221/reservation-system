@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="review-ttl">
        <h2>レビュー投稿</h2>
    </div>
    <div class="review-form">
        <form action="{{ route('reviews.store',$reservation->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rating">評価（1〜5）</label><br>
                <div class="star-rating">
                    @for($i=5;$i>=1;$i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                        <label for="star{{ $i }}">★</label>
                    @endfor
                </div>
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="comment">コメント</label><br>
                <textarea name="comment" rows="4">{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="btn">
                <button type="submit">レビューを投稿する</button>
            </div>
        </form>
    </div>
</div>
@endsection