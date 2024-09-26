<?php

namespace App\Interfaces;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function storeProduct(StoreRequest $request);
    public function updateProduct(UpdateRequest $request, Product $product);
}
