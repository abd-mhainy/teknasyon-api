<?php

namespace App\Repositories;

use App\Models\Device;
use App\Models\Purchase;
use App\Models\Settings;
use App\ValueObject\RegisterPayload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class SettingsRepository
 * @package App\Repositories
 */
class SettingsRepository implements SettingsRepositoryInterface
{
    /** @var Builder $setting */
    protected $setting;

    /**
     * DeviceRepository constructor.
     */
    public function __construct()
    {
        $this->setting = new Settings();
    }

    /**
     * @param string $settingName
     * @return string
     */
    public function getSettingValueByName(string $settingName): string
    {
        return $this->setting->where('name', $settingName)->first()->value;
    }
}
