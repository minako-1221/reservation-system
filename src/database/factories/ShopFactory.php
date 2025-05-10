<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->company,
            'area_id'=>Area::factory(),
            'genre_id'=>Genre::factory(),
            'image_path'=>'images/default.jpg',
        ];
    }
}
