<?php


namespace Tests\Feature\Users;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MakeUserCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_default_user_can_be_made_via_an_artisan_command()
    {
        Artisan::call('user:make');

        $this->assertDatabaseHas('users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'superadmin' => true
        ]);

        $user = User::where('email', 'joe@example.com')->first();
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     *@test
     */
    public function a_user_can_be_generated_with_a_giver_name()
    {
        Artisan::call('user:make', ['attributes' => ['Test Name']]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test Name',
            'email' => 'joe@example.com',
            'superadmin' => true
        ]);

        $user = User::where('email', 'joe@example.com')->first();
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     *@test
     */
    public function a_user_can_be_made_with_a_given_name_and_email()
    {
        Artisan::call('user:make', ['attributes' => ['Test Name', 'test@example.com']]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'superadmin' => true
        ]);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     *@test
     */
    public function a_user_can_be_made_with_a_giver_name_and_email_and_password()
    {
        Artisan::call('user:make', ['attributes' => ['Test Name', 'test@example.com', 'secretly']]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'superadmin' => true
        ]);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue(Hash::check('secretly', $user->password));
    }

    /**
     *@test
     */
    public function a_user_can_be_made_a_non_superadmin_by_passing_in_regular_option()
    {
        Artisan::call('user:make', ['--regular' => true]);

        $this->assertDatabaseHas('users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'superadmin' => false
        ]);

        $user = User::where('email', 'joe@example.com')->first();
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     *@test
     */
    public function the_regular_option_can_be_passed_before_the_arguments()
    {
        Artisan::call('user:make', ['--regular' => true, 'attributes' => ['Testyface', 'testy@example.con']]);

        $this->assertDatabaseHas('users', [
            'name' => 'Testyface',
            'email' => 'testy@example.con',
            'superadmin' => false
        ]);

        $user = User::where('email', 'testy@example.con')->first();
        $this->assertTrue(Hash::check('password', $user->password));
    }
}