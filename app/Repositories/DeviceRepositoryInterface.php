<?php

namespace App\Repositories;

use App\Models\Device;
use App\ValueObject\RegisterPayload;
use App\ValueObject\ReportPayload;

/**
 * Interface DeviceRepositoryInterface
 * @package App\Repositories
 */
interface DeviceRepositoryInterface
{
    /**
     * @param array $deviceData
     * @return Device
     */
    public function saveDevice(array $deviceData): Device;

    /**
     * @param RegisterPayload $registerPayload
     * @return Device|null
     */
    public function deviceRegisteredBefore(RegisterPayload $registerPayload): ?Device;

    /**
     * @param RegisterPayload $registerPayload
     * @return string
     */
    public function updateWithChangeClientToken(RegisterPayload $registerPayload): string;

    /**
     * @param string $clientToken
     * @return Device|null
     */
    public function getDeviceByClientToken(string $clientToken): ?Device;

    /**
     * @param ReportPayload $reportPayload
     * @return array
     */
    public function generateReport(ReportPayload $reportPayload): array;
}
