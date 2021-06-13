<?php

namespace App\Repositories;

use App\Models\Device;
use App\Models\Purchase;
use App\ValueObject\RegisterPayload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class PurchaseRepository
 * @package App\Repositories
 */
class PurchaseRepository implements PurchaseRepositoryInterface
{
    /** @var Builder $purchase */
    protected $purchase;

    /**
     * DeviceRepository constructor.
     */
    public function __construct()
    {
        $this->purchase = new Purchase();
    }

    /**
     * @param array $purchaseDate
     * @return Purchase
     */
    public function savePurchase(array $purchaseDate): Purchase
    {
        return $this->purchase->create($purchaseDate);
    }
}
