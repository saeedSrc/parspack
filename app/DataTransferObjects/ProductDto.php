<?php

namespace App\DataTransferObjects;

class ProductDto
{
    public function __construct(public string $name, public int $user_id)
    {
    }

    public static function fromArray(array $data): static
    {
        return new static($data['name'], $data['user_id']);
    }
}
