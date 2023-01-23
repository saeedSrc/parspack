<?php
namespace App\Actions;
use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\ResultDto;

interface CreateCommentInterface
{
    public function create(CommentDto $dto):ResultDto;
}
