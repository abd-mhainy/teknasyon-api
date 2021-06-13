<?php

namespace App\Repositories;

use App\Models\Device;
use App\Models\Purchase;
use App\ValueObject\RegisterPayload;

/**
 * Interface SettingsRepositoryInterface
 * @package App\Repositories
 */
interface SettingsRepositoryInterface
{
    /**
     * @param string $settingName
     * @return Purchase
     */
    public function getSettingValueByName(string $settingName): string;
}
