<?php

namespace App\Console\Commands;

use App\DataTransferObjects\ProductDto;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class createProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product {product_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will create product.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pName = $this->argument('product_name');
        $product = ['name' => $pName, 'user_id' => 79];
        (new ProductController())->create(ProductDto::fromArray($product));
        error_log('Product created with name: ' . $pName);
    }
}
