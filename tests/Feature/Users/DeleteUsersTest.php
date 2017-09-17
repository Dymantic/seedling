<?php


namespace Tests\Feature\Users;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_user_may_be_deleted()
    {
        $this->disableExceptionHandling();
        $user = $this->createUser();

        $response = $this->asLoggedInUser()->json('DELETE', "/admin/users/{$user->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}