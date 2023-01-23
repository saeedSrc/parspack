<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    /**
     * Login as default API user and get token back.
     *
     * @return void
     */
    public function testLoginShouldWork()
    {
        $baseUrl = Config::get('custom.api_login_path');

        $username = Config::get('custom.apiUser');
        $password = Config::get('custom.apiPassword');

        $response = $this->json('POST', $baseUrl . '/', [
            'username' => $username,
            'password' => $password
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'authorisation' => [
                    'token',
                    'type'
                ],
            ]);
    }


    /**
     * Register as default API user and get token back.
     *
     * @return void
     */
    public function testRegisterShouldNotWork()
    {
        $baseUrl = Config::get('custom.api_register_path');

        $username = Config::get('custom.apiUser');
        $password = Config::get('custom.apiPassword');

        $response = $this->json('POST', $baseUrl . '/', [
            'username' => $username,
            'password' => $password
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'username',
                ],
            ]);
    }
}
