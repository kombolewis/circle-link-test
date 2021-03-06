<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthicated_users_are_redirected()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect(route('login'));
    }


    public function test_login_page() {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
