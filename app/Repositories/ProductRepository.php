<?php

namespace App\Repositories;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function storeProduct(StoreRequest $request): Product
    {
        return Product::create($request->all());
    }

    public function updateProduct(UpdateRequest $request, Product $product): Product
    {
        $product->update($request->all());

        return $product;
    }
}
