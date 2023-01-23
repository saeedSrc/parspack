<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;


class CommentApiTest extends TestCase
{
    /**
     * Comment as default API user and get token back.
     *
     * @return void
     */
    public function testAddCommentShouldNotWork()
    {
        $url = Config::get('custom.api_add_comment_path');


        $response = $this->json('POST', $url . '/', [
            'comment' => "this is test comment",
            'p_name' => 'this is product name'
        ]);

        $response
            ->assertStatus(401)
            ->assertJsonStructure([
                'message',
            ]);
    }


    /**
     * Comment as default API user and get token back.
     *
     * @return void
     */
    public function testAddCommentShouldWork()
    {
        $url = Config::get('custom.api_add_comment_path');
        $user = User::find(81);
        $this->be($user);

        $response = $this->json('POST', $url . '/', [
            'comment' => "this is test comment",
            'p_name' => Str::random(10),
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                  'data' => [
                     [
                         'comment', 'user_id', 'product_id'
                     ]
                  ]

            ]);
    }



}
