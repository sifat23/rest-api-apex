<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\PlaceRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\OrderRepository;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function orderPlace(PlaceRequest $request): JsonResponse
    {
        //get a collection all requested product from user
        $products = Product::whereIn('id', $request->products)
            ->get();

        //get a array of quantities from user
        $quantities = $request->quantities;

        //check products stock before ordering
        $this->repository->checkStockItem($products, $quantities);

        //calculate total amount or this order
        $totalAmount = $this->repository->calculateTotalCost($products, $quantities);

        try {
            DB::beginTransaction();

            //insert order
            $order = $this->repository->placeOrder($totalAmount);

            //insert products to this order
            $this->repository->placeOrderItems($order, $products, $quantities);

            //manage stock from products table
            $this->repository->manageStock($products, $quantities);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        $result = [
            'message' => 'Order placed successfully!'
        ];

        return $this->sendSuccessJson($result);
    }

    public function orderHistory()
    {
        $orderHistory = Order::where('user_id', Auth::id())
            ->with(['orderItems.product'])
            ->get();

        $result = [
            'orders' => $orderHistory,
        ];

        return $this->sendSuccessJson($result);
    }
}
