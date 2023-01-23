<?php

namespace App\Http\Controllers;

use App\Actions\CreateCommentInterface;
use App\Actions\CreateProductInterface;
use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\ProductDto;
use App\Events\NewComment;
use App\Http\Requests\Comment as CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(
        private CreateProductInterface $product,
        private CreateCommentInterface $comment,
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

        return response()->json([
            'status' => 'success',
            'comment' => $comment_result,
        ]);
    }

}
