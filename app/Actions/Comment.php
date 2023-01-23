<?php
namespace App\Actions;
use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;
use App\Models\Comment as CommentModel;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Comment implements CommentInterface {

    public function create(CommentDto $dto):CommentModel
    {
        $comment = new CommentModel();
        $comment->comment = $dto->comment;
        $comment->user_id = $dto->user_id;
        $comment->product_id = $dto->product_id;
        $comment->save();
        $result = ['id' => $comment->id, 'exist' => false];
        return $comment;
        return array(ResultDto::fromArray($result));
    }
}
