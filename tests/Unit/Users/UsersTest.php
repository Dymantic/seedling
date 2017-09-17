<?php

namespace Tests\Unit\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_user_may_be_presented_as_a_jsonable_array()
    {
        $user = $this->createUser([
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'superadmin' => false
        ]);

        $expected = [
            'id' => $user->id,
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'superadmin' => false
        ];

        $this->assertEquals($expected, $user->toJsonableArray());
    }

    /**
     *@test
     */
    public function a_user_can_be_promoted_to_a_superadmin()
    {
        $user = $this->createUser(['superadmin' => false]);

        $user->promoteToSuperAdmin();

        $this->assertTrue($user->fresh()->superadmin);
    }

    /**
     *@test
     */
    public function a_user_can_be_demoted_to_a_regular_user()
    {
        $user = $this->createUser(['superadmin' => true]);

        $user->demoteToRegularUser();

        $this->assertFalse($user->fresh()->superadmin);
    }

    /**
     *@test
     */
    public function a_user_can_be_registered_which_also_hashes_the_password()
    {
        $user_attributes = [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'superadmin' => false,
            'password' => 'password'
        ];

        $user = User::register($user_attributes);

        $this->assertEquals('Test Name', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertFalse($user->superadmin);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     *@test
     */
    public function a_users_password_may_be_reset()
    {
        $user = $this->createUser(['password' => 'password'], true);

        $user->resetPassword('secretly');

        $this->assertTrue(Hash::check('secretly', $user->fresh()->password));
    }
}