<?php

namespace App\Repositories;

use App\Models\Device;
use App\ValueObject\RegisterPayload;
use App\ValueObject\ReportPayload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class DeviceRepository
 * @package App\Repositories
 */
class DeviceRepository implements DeviceRepositoryInterface
{
    /** @var Builder $device */
    protected $device;

    /**
     * DeviceRepository constructor.
     */
    public function __construct()
    {
        $this->device = new Device();
    }

    /**
     * @param array $deviceData
     * @return Device
     */
    public function saveDevice(array $deviceData): Device
    {
        $deviceData['clientToken'] = Str::uuid();

        return $this->device->create($deviceData);
    }

    /**
     * @param RegisterPayload $registerPayload
     * @return Device|null
     */
    public function deviceRegisteredBefore(RegisterPayload $registerPayload): ?Device
    {
        return $this->device
            ->where('uid', $registerPayload->getUid())
            ->where('appId', $registerPayload->getAppId())
            ->first();
    }

    /**
     * @param RegisterPayload $registerPayload
     * @return string
     */
    public function updateWithChangeClientToken(RegisterPayload $registerPayload): string
    {
        $device = $this->device
            ->where('uid', $registerPayload->getUid())
            ->where('appId', $registerPayload->getAppId())
            ->first();
        $newToken = Str::uuid();

        $device->update(['clientToken' => $newToken, 'status' => 'renewed']);

        return $newToken;
    }

    /**
     * @param string $clientToken
     * @return Device|null
     */
    public function getDeviceByClientToken(string $clientToken): ?Device
    {
        return $this->device->where('clientToken', $clientToken)->first();
    }

    /**
     * @param ReportPayload $reportPayload
     * @return array
     */
    public function generateReport(ReportPayload $reportPayload): array
    {
        return $this->device->when($reportPayload->getAppId(), function (Builder $query) use ($reportPayload) {
            $query->where('appId', $reportPayload->getAppId());
        })
        ->when($reportPayload->getOs(), function (Builder $query) use ($reportPayload) {
            $query->where('os', $reportPayload->getOs());
        })
        ->when($reportPayload->getStartDate(), function (Builder $query) use ($reportPayload) {
            $query->where('created_at', '>=', $reportPayload->getStartDate());
            $query->where('created_at', '<', $reportPayload->getEndDate());
        })
        ->get()
        ->toArray();
    }
}
