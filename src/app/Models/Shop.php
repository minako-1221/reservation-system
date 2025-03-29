<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'area_id', 'genre_id', 'description', 'image_path'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function scopeFilterByArea($query, $areaId)
    {
        if(!empty($areaId)){
            return $query->where('area_id', $areaId);
        }
        return $query;
    }

    public function scopeFilterByGenre($query,$genreId)
    {
        if(!empty($genreId)){
            return $query->where('genre_id', $genreId);
        }
        return $query;
    }

    public function scopeFilterByKeyword($query,$keyword)
    {
        if(!empty($keyword)){
            return $query->where('name', 'like', "%{$keyword}%");
        }
        return $query;
    }
}
