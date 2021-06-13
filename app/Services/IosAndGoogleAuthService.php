<?php

namespace App\Services;

use App\Models\Device;
use Illuminate\Support\Carbon;

/**
 * Class IosAndGoogleAuthService
 * @package App\Services
 */
class IosAndGoogleAuthService
{
    /**
     * @param Device $device
     * @param string $receipt
     * @return string|bool
     */
    public function authenticate(Device $device, string $receipt)
    {
        $receiptLastChar = substr($receipt, -1);

        if (!is_numeric($receiptLastChar)) {
            return 'error';
        }

        if ((int)$receiptLastChar % 2 === 0) {
            return false;
        }

        if ($device->os === 'ios') {
            return Carbon::now()->addMonth()->tz('America/Mazatlan')->toDateTimeString();
        }

        return Carbon::now()->addMonth()->toDateTimeString();
    }
}
