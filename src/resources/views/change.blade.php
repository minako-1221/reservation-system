@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/change.css') }}" />
@endsection

@section('content')
<div class="container">
    <div class="reservation">
        <form action="{{ route('reservation.update', $reservation->id) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="reservation-form">
                <div class="reservation-ttl">
                    <h3>変更内容</h3>
                </div>
                <div class="form-input">
                    <input type="hidden" name="shop_id" value="{{ $reservation->shop->id }}">
                    <div class="form-item">
                        <input type="text" id="reservation_date" name="reservation_date" class="form-date"
                            value="{{old('reservation_date',\Carbon\Carbon::parse($reservation->reservation_datetime)->format('Y/m/d')) }}" required>
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
                                <option value="{{ $time }}" {{old('reservation_time', \Carbon\Carbon::parse( $reservation->reservation_datetime)->format('H:i')) == $time ? 'selected' : '' }}>
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
                                <option value="{{ $i }}" {{ $reservation->number_of_people == $i ? 'selected' : '' }}>
                                    {{ $i }}人
                                </option>
                            @endfor
                        </select>
                        @error('number_of_people')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="reservation-btn">
                    <button class="reserve-btn" type="submit">予約を変更する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/change.js') }}"></script>
@endsection