<?php
namespace App\Actions;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;

interface CreateProductInterface
{
    public function create(ProductDto $dto) :ResultDto;
}
