<?php
namespace App\Actions;
use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CreateComment implements CreateCommentInterface {

    public function create(CommentDto $dto):ResultDto
    {
        $comment = new Comment();
        $comment->comment = $dto->comment;
        $comment->user_id = $dto->user_id;
        $comment->product_id = $dto->product_id;
        $comment->save();
        $result = ['id' => $comment->id, 'exist' => false];
        return ResultDto::fromArray($result);
    }
}
