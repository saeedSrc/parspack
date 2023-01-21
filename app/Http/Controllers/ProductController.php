<?php

namespace App\Http\Controllers;
use App\DataTransferObjects\ProductDto;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // singleton pattern
    public function create(ProductDto $dto) :int
    {
        $product = Product::firstOrCreate(['name' => $dto->name], ['name' => $dto->name, 'user_id' => $dto->user_id]);
        return $product->id;
    }



}
