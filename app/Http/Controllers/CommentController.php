<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ProductDto;
use App\Events\NewComment;
use App\Http\Requests\Comment as CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function insert(CommentRequest $request)
    {
        // we first should get product_id with product_name
        $pName = $request->get('p_name');
        $product = ['name' => $pName, 'user_id' => Auth::id()];

        // create method either create a new product or return product that hast already been in database
        $result = (new ProductController())->create(ProductDto::fromArray($product));

        // creating comment
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->product_id = $result->id;
        $comment->save();

        $Event = ['p_name' => $pName];
        event(NewComment::broadcast($Event));

        return response()->json([
            'status' => 'success',
            'comment' => $comment,
        ]);
    }

    public function create($request)
    {

    }

}
