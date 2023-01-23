<?php
namespace App\Actions;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;
use App\Models\Product as ProductModel;

class Product implements ProductInterface {
    // singleton pattern => creational pattern
    public function create(ProductDto $dto) :ResultDto
    {
        $product = ProductModel::where('name', '=', $dto->name)->first();
        $exist = true;
        if ($product == null) {
            $product = ProductModel::create(['name' => $dto->name, 'user_id' => $dto->user_id]);
            $exist = false;
        }
        $result = ['id' => $product->id, 'exist' => $exist];
        return ResultDto::fromArray($result);
    }
}
