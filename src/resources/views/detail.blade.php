@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
                <div class="container">
                    <div class="detail">
                        <div class="detail-ttl">
                            <a href="/"><</a>
                            <h2>{{ $shop->name }}</h2>
                        </div>
                        <div class="detail-img">
                            <img src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}" class="img-fluid">
                        </div>
                        <div class="detail-hush">
                            <p>#{{ $shop->area->name }} #{{ $shop->genre->name }}</p>
                        </div>
                        <div class="detail-text">
                            <p>{{ $shop->description }}</p>
                        </div>
                    </div>
                    <div class="reservation">
                        <form action="{{ route('reservation.store', $shop->id) }}" method="POST" class="form">
                            @csrf
                            <div class="reservation-form">
                                <div class="reservation-ttl">
                                    <h3>予約</h3>
                                </div>
                                <div class="form-input">
                                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    <div class="form-item">
                                        <input type="text" id="reservation_date" name="reservation_date" class="form-date"
                                            value="{{ old('reservation_date', \Carbon\Carbon::today()->format('Y/m/d')) }}" required>
                                        <i class="fa-solid fa-calendar" id="calendar-icon"></i>
                                    </div>
                                    @error('reservation_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-item">
                                        @php
    $times = [];
    for ($time = \Carbon\Carbon::parse('11:00'); $time <= \Carbon\Carbon::parse('20:00'); $time->addMinutes(30)) {
        $times[] = $time->format('H:i');
    }
                                        @endphp
                                        <select id="reservation_time" name="reservation_time" class="form-time" required>
                                            @foreach($times as $time)
                                                <option value="{{ $time }}" {{ old('reservation_time') == $time ? 'selected' : '' }}>
                                                    {{ $time }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('reservation_time')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-item">
                                        <select id="number_of_people" name="number_of_people" class="form-number" required>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ old('number_of_people') == $i ? 'selected' : '' }}>{{ $i }}人
                                                </option>
                                            @endfor
                                        </select>
                                        @error('number_of_people')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @if($reservations->isNotEmpty())
                                    @foreach ($reservations as $reservation)
                                        <div class="reservation-list">
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
                                        </div>
                                    @endforeach
                                @endif
                                <div class="reservation-btn">
                                    @auth
                                        <button class="reserve-btn" type="submit">予約する</button>
                                    @else
                                        <button class="reserve-btn" type="button" disabled>予約する</button>
                                    @endauth
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

@endsection

@section('js')
    <script src="{{ asset('js/detail.js') }}"></script>
@endsection