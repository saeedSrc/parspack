<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ProductDto;
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

    public function create(CommentRequest $request)
    {
        $product = ['name' => $request->get('p_name'), 'user_id' => Auth::id()];
        $result = (new ProductController())->create(ProductDto::fromArray($product));
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->product_id = $result->id;
        $comment->save();
        return response()->json([
            'status' => 'success',
            'comment' => $comment,
        ]);
    }

}
