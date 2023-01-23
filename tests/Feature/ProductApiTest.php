<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;


class ProductApiTest extends TestCase
{
    /**
     * Product as default API user and get token back.
     *
     * @return void
     */
    public function testGetProductsShouldNotWork()
    {
        $url = Config::get('custom.api_get_products_path');
        var_dump($url);

        $response = $this->json('GET', $url . '/', [

        ]);

        $response
            ->assertStatus(401)
            ->assertJsonStructure([
                'message',
            ]);
    }


    /**
     * Product as default API user and get token back.
     *
     * @return void
     */
    public function testGetProductsShouldWork()
    {
        $url = Config::get('custom.api_get_products_path');
        $user = User::find(81);
        $this->be($user);

        $response = $this->json('GET', $url . '/', [
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                  'data' => [
                     [
                        [ 'id', 'name', 'comments']
                     ]
                  ]

            ]);
    }



}
