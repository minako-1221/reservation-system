<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'shop_id' => \App\Models\Shop::factory(),
            'reservation_datetime' => Carbon::tomorrow(),
            'number_of_people' => 2,
        ];
    }
}
