<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function checkStockItem(Collection $products, array $quantities);

    public function calculateTotalCost(Collection $products, array $quantities);

    public function placeOrder(float $totalAmount);
    public function placeOrderItems(Order $order, Collection $products, array $quantities);
    public function manageStock(Collection $products, array $quantities);

}
