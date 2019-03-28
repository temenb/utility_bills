<?php
namespace Tests\Feature\Auth;

use App\Models\Entities\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * The login form can be displayed.
     *
     * @return void
     */
    public function testLoginFormDisplayed()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    /**
     * A valid user can be logged in.
     *
     * @return void
     */
    public function testLoginAValidUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', $this->loginCredentials($user));
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    /**
     *
     */
    public function testRedirectAuthorizedUser()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/login');
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
    /**
     * An invalid user cannot be logged in.
     *
     * @return void
     */
    public function testDoesNotLoginAnInvalidUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/login', $this->loginCredentialsInvalid($user));
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
    /**
     * A logged in user can be logged out.
     *
     * @return void
     */
    public function testLogoutAnAuthenticatedUser()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }

    /**
     * @param $user
     * @return array
     */
    private function loginCredentials($user): array
    {
        return [
            'name' => $user->name,
            'password' => strrev($user->name),
        ];
    }

    /**
     * @param $user
     * @return array
     */
    private function loginCredentialsInvalid($user): array
    {
        $credentials = $this->loginCredentials($user);
        $credentials['password'] .= 'fake';
        return $credentials;
    }
}