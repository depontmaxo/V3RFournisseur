<?php
/* Example, ne pas utiliser*/

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase; // Use this trait to reset the database after each test

    /** @test */
    public function a_user_can_view_the_login_page()
    {
        $response = $this->get('/login'); // Assuming your login page is at /login

        $response->assertStatus(200); // Check if the page returns a 200 status
        $response->assertViewIs('auth.login'); // Check if the view is correct (optional)
    }

    /** @test */
    public function a_user_can_login_with_correct_credentials()
    {
        // Create a user with known credentials
        $user = \App\Models\User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt($password = 'password123'),
        ]);

        // Attempt to log in with these credentials
        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => $password,
        ]);

        // Check if login was successful and user is redirected
        $response->assertRedirect('/home'); // Adjust the redirect path based on your app
        $this->assertAuthenticatedAs($user); // Check if the user is authenticated
    }

    /** @test */
    public function a_user_cannot_login_with_incorrect_credentials()
    {
        // Attempt to log in with incorrect credentials
        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'wrongpassword',
        ]);

        // Check if login was unsuccessful
        $response->assertSessionHasErrors(); // Ensure errors are present in the session
        $this->assertGuest(); // Ensure the user is not authenticated
    }
}
