<?php

namespace App\Services;

use App\Models\Device;
use App\Repositories\DeviceRepositoryInterface;
use App\Repositories\PurchaseRepositoryInterface;
use App\Traits\DateConverter;
use App\ValueObject\PurchasePayload;
use Exception;

/**
 * Class PurchaseService
 * @package App\Services
 */
class PurchaseService
{
    use DateConverter;

    protected $purchaseRepo;
    protected $deviseRepo;
    protected $iosAbdGoogleAuthService;

    /**
     * PurchaseService constructor.
     * @param PurchaseRepositoryInterface $purchaseRepo
     * @param DeviceRepositoryInterface $deviceRepo
     * @param IosAndGoogleAuthService $iosAndGoogleAuthService
     */
    public function __construct(
        PurchaseRepositoryInterface $purchaseRepo,
        DeviceRepositoryInterface $deviceRepo,
        IosAndGoogleAuthService $iosAndGoogleAuthService
    ) {
        $this->purchaseRepo = $purchaseRepo;
        $this->deviseRepo = $deviceRepo;
        $this->iosAbdGoogleAuthService = $iosAndGoogleAuthService;
    }

    /**
     * @param PurchasePayload $purchasePayload
     * @return array
     * @throws Exception
     */
    public function purchase(PurchasePayload $purchasePayload): array
    {
        /** @var Device $device */
        $device = $this->deviseRepo->getDeviceByClientToken($purchasePayload->getClientToken());

        if (!$device) {
            return ['status' => 'error', 'message' => 'device not exist'];
        }

        $expiryDate = $this->iosAbdGoogleAuthService->authenticate($device, $purchasePayload->getReceipt());

        if ($expiryDate === 'error') {
            return ['status' => 'error', 'message' => 'please check receipt you are sending'];
        }

        if (!$expiryDate) {
            return ['status' => 'error', 'message' => 'receipt cannot be authenticated'];
        }

        if ($device->os === 'ios') {
            $expiryDate = $this->getUtcDate($expiryDate);
        }

        $purchasePayload = $purchasePayload->toArray();
        $purchasePayload['expireDate'] = $expiryDate;
        $purchasePayload['deviceId'] = $device->id;

        $this->purchaseRepo->savePurchase($purchasePayload);

        return ['status' => true, 'data' => $purchasePayload];
    }
}
