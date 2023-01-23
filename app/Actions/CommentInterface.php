<?php
namespace App\Actions;
use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\ResultDto;

interface CommentInterface
{
    public function create(CommentDto $dto):\App\Models\Comment;
}
