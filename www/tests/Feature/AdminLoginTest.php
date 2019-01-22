<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $response = $this->json('POST', '/login', [
            'email'    => '123456@gmail.com',
            'password' => '123456',
        ]);

        $response
            ->assertStatus(302)
            ->assertLocation('/home');

    }

    public function testLoginFail()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $response = $this->json('POST', '/login', [
            'email'    => '123456@gmail.com',
            'password' => '12345',
        ]);

        $response
            ->assertStatus(422);
    }
}
