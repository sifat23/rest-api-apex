<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private ProductRepository $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;

    }
    public function store(StoreRequest $request)
    {
        $product = $this->repository->storeProduct($request);

        return $this->sendSuccessJson([
            'message' => 'Product Successfully Stored!',
            'product' => $product
        ]);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $product = $this->repository->updateProduct($request, $product);

        return $this->sendSuccessJson([
            'message' => 'Product Successfully Updated!',
            'product' => $product
        ]);
    }
}
