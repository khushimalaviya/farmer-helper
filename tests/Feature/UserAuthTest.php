<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_page_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('home'); // assuming home.blade.php
    }

    /** @test */
    public function registration_page_loads()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->post('/register', [
            'username' => 'TestUser',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'contact_no' => '1234567890',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function login_page_loads()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/home'); // change if your redirect is different
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'invalid',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');
        $response->assertRedirect('/login'); // change if needed

        $this->assertGuest();
    }
}
