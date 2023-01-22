<?php

namespace App\Http\Controllers;

use App\Actions\CreateProductInterface;
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
    ) {
    }

    public function insert(CommentRequest $request)
    {
        // we first should get product_id with product_name
        $pName = $request->get('p_name');
        $product = ['name' => $pName, 'user_id' => Auth::id()];

        // calling create method through product interface (adapter pattern => structural)
        // create method either creates a new product or return product that hast already been in database.
        $result = $this->product->create(ProductDto::fromArray($product));

        // creating comment
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->product_id = $result->id;
        $comment->save();

        // create new event for inserting/updating  "product: comment_count" file
        event(NewComment::broadcast($pName));

        return response()->json([
            'status' => 'success',
            'comment' => $comment,
        ]);
    }

}
