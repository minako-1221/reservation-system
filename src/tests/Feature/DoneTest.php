<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;

class DoneTest extends TestCase
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
    public function testDisplay()
    {
        $response = $this->get('/done/' . $this->shop->id);

        $response->assertStatus(200);
        $response->assertSee('ご予約ありがとうございます');
        $response->assertSee('戻る');
        $response->assertSee('/detail/' . $this->shop->id);
    }
}
