<?php

namespace Tests\Feature\Layouts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AppTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testHeaderLogo()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Rese');
        $response->assertSee('menu-toggle');
    }

    public function testGuestNavbarLinks()
    {
        $response = $this->get('/');

        $response->assertSee('Home');
        $response->assertSee('Registration');
        $response->assertSee('Login');
    }

    public function testAuthenticatedNavbarLinks()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertSee('Home');
        $response->assertSee('Logout');
        $response->assertSee('Mypage');
    }
}
