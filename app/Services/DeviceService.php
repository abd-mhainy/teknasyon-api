<?php

namespace App\Services;

use App\Events\StatusChanged;
use App\Repositories\DeviceRepositoryInterface;
use App\ValueObject\RegisterPayload;

/**
 * Class DeviceService
 * @package App\Services
 */
class DeviceService
{
    protected $deviceRepo;

    /**
     * DeviceService constructor.
     * @param DeviceRepositoryInterface $deviceRepo
     */
    public function __construct(DeviceRepositoryInterface $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    /**
     * @param RegisterPayload $registerPayload
     * @return array|null
     */
    public function registerDevice(RegisterPayload $registerPayload): ?array
    {
        $registeredBefore = $this->deviceRepo->deviceRegisteredBefore($registerPayload);

        if ($registeredBefore) {
            $clientToken = $this->deviceRepo->updateWithChangeClientToken($registerPayload);

            StatusChanged::dispatch($registeredBefore, 1);

            return ['status' => 'ok', 'clientToken' => $clientToken];
        }

        $createdModel = $this->deviceRepo->saveDevice($registerPayload->toArray());

        if (!$createdModel) {
            return ['status' => 'error', 'clientToken' => null];
        }

        StatusChanged::dispatch($createdModel, 1);

        return ['status' => 'ok', 'clientToken' => $createdModel->clientToken];
    }

    /**
     * @param string $clientToken
     * @return array
     */
    public function check(string $clientToken): array
    {
        $device = $this->deviceRepo->getDeviceByClientToken($clientToken);

        if (!$device) {
            return ['status' => 'error', 'message' => 'client token you entered is wrong please check'];
        }

        return [
            'status' => true,
            'data' => ['deviceStatus' => $device->status, 'appId' => $device->appId, 'uid' => $device->uId],
        ];
    }
}
