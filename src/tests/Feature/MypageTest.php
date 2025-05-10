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
use App\Models\Favorite;
use Carbon\Carbon;

class MypageTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $shop;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);

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

        Reservation::factory()->create([
            'user_id' => $this->user->id,
            'shop_id' => $this->shop->id,
            'reservation_datetime' => Carbon::tomorrow(),
            'number_of_people' => 2,
        ]);

        Favorite::factory()->create([
            'user_id' => $this->user->id,
            'shop_id' => $this->shop->id,
        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDisplay()
    {
        $response = $this->get('/mypage');

        $response->assertStatus(200);
        $response->assertSee('予約状況');
        $response->assertSee('お気に入り店舗');
        $response->assertSee('仙人');
        $response->assertSee('東京');
        $response->assertSee('寿司');
        $response->assertSee('2');
    }
}
