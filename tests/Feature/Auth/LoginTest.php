<?php


namespace Tests\Feature\Auth;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_existing_user_can_login()
    {
        $this->disableExceptionHandling();
        $user = $this->createUser([
            'email' => 'test@example.com',
            'password' => 'password'
        ], true);

        $response = $this->post("/admin/login", [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin');

        $this->assertTrue(auth()->user()->is($user));
    }
}