<?php

namespace Tests\Unit\Repositories\Notification;


use App\Actions\Comment;
use App\DataTransferObjects\CommentDto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

    public function testCommentInsertShouldWork(): void
    {
        //arrange
        $comment = CommentDto::fromArray(['comment' => "test comment", "user_id" => 81, "product_id" => 25]);
        $commentRepo = new Comment();

        //act
        $result = $commentRepo->create($comment);

        //assert
        $this->assertDatabaseHas('comments', $result->toArray());
        $this->assertNotNull($result->id);
    }
}
