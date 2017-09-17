<?php


namespace Tests\Feature\Auth;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_logged_in_user_may_log_out()
    {
        $this->disableExceptionHandling();
        $user = $this->createUser();
        $this->actingAs($user);
        $this->assertTrue(auth()->check());

        $response = $this->post('/admin/logout');
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $this->assertFalse(auth()->check());
    }
}