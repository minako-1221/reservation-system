<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;


class DetailTest extends TestCase
{
    use RefreshDatabase;

    protected $shop;

    protected function setUp(): void
    {
        parent::setUp();

        $areas = Area::factory()->createMany([
            ['name' => '東京'],
            ['name' => '大阪'],
            ['name' => '福岡'],
        ]);

        $genres = Genre::factory()->createMany([
            ['name' => '寿司'],
            ['name' => '焼肉'],
            ['name' => 'ラーメン'],
        ]);

        $this->shop=Shop::factory()->create([
                'name' => '仙人',
                'area_id' => $areas[0]->id,
                'genre_id' => $genres[0]->id,
                'image_path' => 'images/aaa.jpg',
                'description' => '店舗説明',
        ]);
        $this->shop=Shop::factory()->create([
                'name' => '牛助',
                'area_id' => $areas[1]->id,
                'genre_id' => $genres[1]->id,
                'image_path' => 'images/bbb.jpg',
                'description' => '店舗説明',
            ]);
        $this->shop=Shop::factory()->create([
                'name' => '志摩家',
                'area_id' => $areas[2]->id,
                'genre_id' => $genres[2]->id,
                'image_path' => 'images/ccc.jpg',
                'description' => '店舗説明',
        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShopDetailDisplay()
    {
        $response = $this->get('/detail/' . $this->shop->id);

        $response->assertStatus(200);
        $response->assertSee($this->shop->name);
        $response->assertSee($this->shop->area->name);
        $response->assertSee($this->shop->genre->name);
        $response->assertSee($this->shop->description);
        $response->assertSee($this->shop->image_path);
    }

    public function testReservationValidationError()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('reservation.store', $this->shop->id), []);

        $response->assertSessionHasErrors(['reservation_date', 'reservation_time', 'number_of_people']);
    }

    public function testReservationSuccess()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('reservation.store', $this->shop->id), [
            'reservation_date' => Carbon::tomorrow()->format('Y/m/d'),
            'reservation_time' => '12:00',
            'number_of_people' => 2,
            'shop_id' => $this->shop->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'shop_id' => $this->shop->id,
            'number_of_people' => 2,
        ]);
    }
}
