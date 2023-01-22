<?php

namespace App\Http\Controllers;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // singleton pattern
    public function create(ProductDto $dto) :ResultDto
    {
        $product = Product::where('name', '=', $dto->name)->first();
        $exist = true;
        if ($product == null) {
            $product = Product::create(['name' => $dto->name, 'user_id' => $dto->user_id]);
            $exist = false;
        }
        $result = ['id' => $product->id, 'exist' => $exist];
        return ResultDto::fromArray($result);
    }



}
