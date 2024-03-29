<?php
namespace App\Actions;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;

interface ProductInterface
{
    public function create(ProductDto $dto) :ResultDto;
    public function getAll():array;
}
