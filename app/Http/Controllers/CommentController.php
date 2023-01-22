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
        $pName = $request->get('p_name');
        $product = ['name' => $pName, 'user_id' => Auth::id()];
        $result = (new ProductController())->create(ProductDto::fromArray($product));
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->product_id = $result->id;
        $comment->save();

        $fileName = "/opt/myprogram/product_comments";
        $output =  shell_exec("awk -F':' '$1 ==\"" . $pName . "\"{print $2}' " . $fileName);
        $oparray = preg_split('/\s+/', trim($output));
        $lastValue = $oparray[count($oparray) - 1];

        if ($lastValue == null ) {
        shell_exec("echo " . $pName . ": " . 1 . " >> " . $fileName);
        } else {
            shell_exec("sudo -S sed -i.bkp \"\/" . $pName . "\"\/d  $fileName");
            shell_exec("echo " . $pName . ": " . $lastValue + 1 . " >> " . $fileName);
        }

        return response()->json([
            'status' => 'success',
            'comment' => $comment,
        ]);
    }

}
