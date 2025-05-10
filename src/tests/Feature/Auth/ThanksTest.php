<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThanksTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testThanksDisplayed()
    {
        $response = $this->get('/thanks');

        $response->assertStatus(200);
    }
}
