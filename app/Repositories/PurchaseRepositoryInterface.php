<?php

namespace App\Repositories;

use App\Models\Device;
use App\Models\Purchase;
use App\ValueObject\RegisterPayload;

/**
 * Interface PurchaseRepositoryInterface
 * @package App\Repositories
 */
interface PurchaseRepositoryInterface
{
    /**
     * @param array $purchaseDate
     * @return Purchase
     */
    public function savePurchase(array $purchaseDate): Purchase;
}
