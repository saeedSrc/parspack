<?php

namespace Tests\Unit\Repositories\Notification;


use App\Actions\Comment;
use App\Actions\Product;
use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\ProductDto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testProductInsertShouldWork(): void
    {
        //arrange
        $product = ProductDto::fromArray(['name' => "test product", "user_id" => 81]);
        $productRepo = new Product();

        //act
        $result = $productRepo->create($product);

        //assert
        $this->assertEquals(false, $result->exist);
        $this->assertNotNull($result->id);
    }
}
