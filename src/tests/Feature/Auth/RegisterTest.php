<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterDisplayed()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testRegisterSuccess()
    {
        $response = $this->post('/register', [
            'name' => '山田太郎',
            'email' => 'aaa@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/thanks');

        $this->assertDatabaseHas('users', [
            'email' => 'aaa@example.com',
        ]);
    }

    public function testRegisterEmpty()
    {
        $response = $this->from('/register')->post('/register', []);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }

    public function testRegisterValidation()
    {
        User::factory()->create(['email' => 'aaa@example.com']);

        $response = $this->from('/register')->post('/register', [
            'name' => '山田花子',
            'email' => 'aaa@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
