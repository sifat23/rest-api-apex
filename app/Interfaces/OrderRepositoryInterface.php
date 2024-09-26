<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function checkStockItem(Collection $products, array $quantities);

}
