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
}
