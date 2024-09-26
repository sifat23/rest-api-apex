<?php

namespace App\Repositories;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts(): Collection
    {
        $minutes = Config::get('app.cache_minutes');

        return Cache::remember('all_products', now()->addMinutes($minutes), function () {
            return Product::all();
        });
    }
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
