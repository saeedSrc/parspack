<?php

namespace App\DataTransferObjects;

class ResultDto
{
    public function __construct(public int $id, public bool $exist)
    {
    }

    public static function fromArray(array $data): static
    {
        return new static($data['id'], $data['exist']);
    }
}
