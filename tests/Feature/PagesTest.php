<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testLoginPage()
    {
        $response = $this->get(route('login'));
        // $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testRegisterPage()
    {
        $response = $this->get(route('register'));
        // $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function testEntryPage() 
    {
        $response = $this->get('/entries');
        $response->assertRedirect('login');
    }
}
