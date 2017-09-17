<?php


namespace Tests\Feature\Users;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuperAdminsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_superadmin_may_be_created_from_an_existing_user()
    {
        $this->disableExceptionHandling();
        $user = $this->createUser(['superadmin' => false]);

        $response = $this->asLoggedInUser()->json('POST', "/admin/super-admins", [
            'user_id' => $user->id
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id'         => $user->id,
            'superadmin' => true
        ]);
    }

    /**
     *@test
     */
    public function an_existing_user_can_be_demoted_to_a_regular_user()
    {
        $this->disableExceptionHandling();
        $user = $this->createUser(['superadmin' => true]);

        $response = $this->asLoggedInUser()->json('DELETE', "/admin/super-admins/{$user->id}");
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id'         => $user->id,
            'superadmin' => false
        ]);
    }
}