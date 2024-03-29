<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_register_returns_a_view()
    {
        $response = $this->get('/register')
            ->assertViewIs('auth.register');

        $response->assertOk();
    }

    public function test_user_cannot_register_with_any_fields_blanks()
    {

        $response = $this->post(route('register'), [
            'name' => '',
            'username' => '',
            'email' => '',
            'password' => '',
        ]);

        $response->assertInvalid(['name', 'username', 'email', 'password']);
    }

    public function test_registration_must_be_done_with_unique_email()
    {

        $user = User::factory()->create()->toArray();
        $response = $this->post(route('register'), $user);

        $response->assertInvalid(['email']);

    }

    public function test_user_can_register()
    {

        $user = User::factory()->make([])->toArray();
        $user['password'] = 'password';
        //  dd($user);
        $response = $this->post(route('register'), $user);

        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
            'username' => $user['username'],
            'email' => $user['email'],
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirectToRoute('register')->assertSessionHas('success', 'You are successfully registered');
        $this->assertEquals(1, User::count());
    }

    public function test_login_returns_a_view()
    {
        $response = $this->get('/login')
            ->assertViewIs('auth.login');

        $response->assertOk();
    }

    public function test_user_cannot_login_without_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        // Attempt to login
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => '',
        ]);

        $response->
        assertValid(['email'])
            ->assertInvalid(['password']);

    }

    public function test_user_can_login_with_correct_credentials()
    {
        // Create a user to test with
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        // Attempt to login
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assert the user was authenticated
        $this->assertAuthenticatedAs($user);

        // Assert the response was a redirect to the intended page
        $response->assertRedirect('/home');
    }

    public function test_user_cannot_enter_home_route_without_loggin_in()
    {
        // Create a user to test with

        // Attempt to login
        $response = $this->post('login', [
            'email' => '',
            'password' => '',
        ]);
        $response->assertSessionHasErrors(['email', 'password']);
        

        // Assert the response was a redirect to the intended page
        $response->assertRedirect('/');
    }
}
