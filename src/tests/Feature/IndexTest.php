<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;

class IndexTest extends TestCase
{
    use RefreshDatabase;

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

        Shop::factory()->create([
                'name' => '仙人',
                'area_id' => $areas[0]->id,
                'genre_id' => $genres[0]->id,
                'image_path' => 'images/aaa.jpg',
        ]);
        Shop::factory()->create([
                'name' => '牛助',
                'area_id' => $areas[1]->id,
                'genre_id' => $genres[1]->id,
                'image_path' => 'images/bbb.jpg',
            ]);
        Shop::factory()->create([
                'name' => '志摩家',
                'area_id' => $areas[2]->id,
                'genre_id' => $genres[2]->id,
                'image_path' => 'images/ccc.jpg',
        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexDisplayed()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('All area');
        $response->assertSee('All genre');
        $response->assertSee('Search ...');
    }

    public function testGuestFavoriteBtn()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('favorite-btn');
    }

    public function testAuthFavoriteBtn()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('favorite-btn');
    }

    public function testSearchWorks()
    {
        $area = Area::where('name','東京')->first();
        $genre = Genre::where('name','寿司')->first();

        $response = $this->get('/search?area=' . $area->id . '&genre=' . $genre->id . '&keyword=仙人');

        $response->assertStatus(200);
        $response->assertSee('仙人');
    }
}
