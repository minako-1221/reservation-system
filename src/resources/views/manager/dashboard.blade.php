@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="container">
    <div class="shop-ttl">
        <h2>店舗名</h2>
    </div>
    <div class="reservation-list">
        <div class="list-ttl">
            <h3>予約一覧</h3>
            <a href="{{ route('manager.edit') }}">店舗情報更新</a>
        </div>
        <div class="list-table">
            <table class="table">
                <tr>
                    <th>日付</th>
                    <th>時間</th>
                    <th>氏名</th>
                    <th>人数</th>
                </tr>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_datetime)->format('H:i') }}</td>
                        <td>{{ $reservation->user->name }} 様</td>
                        <td>{{ $reservation->number_of_people }}名</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection