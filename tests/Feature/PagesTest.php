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

        $response->assertSee('SmartDiary');
    }
    
    // Test login page 
    public function testLoginPage()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
        $response->assertSee('Login');
    }

    // Test registration page
    public function testRegisterPage()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
        $response->assertSee('Register');
    }

    // Only authenticated users can access the entries endpoint
    public function testEntryPage() 
    {
        $response = $this->get('/entries');
        $response->assertRedirect('login');
    }
}
