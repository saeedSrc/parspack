<?php

namespace App\Http\Controllers;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product as ProductRequest;

class ProductController extends Controller
{

    public function all(ProductRequest $request) {
          return Product::with('comments')->get();
    }


    // singleton pattern
    public function create(ProductDto $dto) :ResultDto  // Result Data Transfer object is a general object that has id of an instance plus whether if it exists or not.
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
