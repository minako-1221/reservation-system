<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'reservation_datetime',
        'number_of_people',
    ];

    protected $dates = ['reservation_datetime'];

    public static function formatReservationDateTime($date, $time)
    {
        return Carbon::createFromFormat('Y/m/d H:i', "$date $time");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
