<?php

namespace App\Http\Controllers;
use App\Actions\CommentInterface;
use App\Actions\ProductInterface;
use App\DataTransferObjects\ProductDto;
use App\DataTransferObjects\ResultDto;
use App\Helpers\Helpers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product as ProductRequest;

class ProductController extends Controller
{

    public function __construct(
        private ProductInterface $product,
    ) {
    }

    public function all() {
        $products = $this->product->getAll();
       return Helpers::SuccessResponse($products);
    }
}
