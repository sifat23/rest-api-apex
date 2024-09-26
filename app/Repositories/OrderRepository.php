<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderRepositoryInterface
{
    public function checkStockItem(Collection $products, array $quantities): array|bool
    {
        foreach ($products as $key => $product) {
            if ($product->stock < $quantities[$key]) {
                return [$product, $quantities[$key]];
            }
        }

        return true;
    }

    public function calculateTotalCost(Collection $products, array $quantities): float
    {
        $totalAmount = 0.0;

        foreach ($products as $key => $product) {
            $totalAmount += floatval($product->price * $quantities[$key]);
        }

        return $totalAmount;
    }

    public function placeOrder(float $totalAmount): Order
    {
        return Order::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'total_amount' => $totalAmount
        ]);
    }

    public function placeOrderItems(Order $order, Collection $products, array $quantities)
    {
        foreach ($products as $key => $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantities[$key],
                'price' => floatval($product->price * intval($quantities[$key]))
            ]);
        }
    }

    public function manageStock(Collection $products, array $quantities)
    {
        foreach ($products as $key => $product) {
            $product->update([
                'stock' => $product->stock - intval($quantities[$key])
            ]);
        }
    }

}
