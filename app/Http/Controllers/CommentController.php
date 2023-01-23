<?php

namespace App\Http\Controllers;

use App\Actions\CommentInterface;
use App\Actions\ProductInterface;
use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\ProductDto;
use App\Events\NewComment;
use App\Helpers\Helpers;
use App\Http\Requests\Comment as CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\arrayHasKey;

class CommentController extends Controller
{
    public function __construct(
        private ProductInterface $product,
        private CommentInterface $comment,
    ) {
    }

    public function insert(CommentRequest $request)
    {
        // we first should get product_id with product_name
        $pName = $request->get('p_name');
        $product = ['name' => $pName, 'user_id' => Auth::id()];

        // calling create method through product interface (adapter pattern => structural)
        // create method either creates a new product or return product that hast already been in database.
        $product_result = $this->product->create(ProductDto::fromArray($product));

        // creating comment
        $comment = ['comment' => $request->comment, 'user_id' => Auth::id(), 'product_id' => $product_result->id];
        $comment_result = $this->comment->create(CommentDto::fromArray($comment));

        // create new event for inserting/updating  "product: comment_count" file
        event(NewComment::broadcast($pName));

        // call helper static method
        return Helpers::SuccessResponse(array($comment_result));
    }

}
