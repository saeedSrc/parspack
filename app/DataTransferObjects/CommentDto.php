<?php

namespace App\DataTransferObjects;

class CommentDto
{
    public function __construct(public string $comment, public int $user_id, public int $product_id)
    {
    }

    public static function fromArray(array $data): static
    {
        return new static($data['comment'], $data['user_id'], $data['product_id']);
    }
}
