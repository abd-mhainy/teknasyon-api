<?php

namespace App\Events;

use App\Models\Device;
use Illuminate\Foundation\Events\Dispatchable;

class StatusChanged
{
    use Dispatchable;

    public $device;
    public $tries;

    /**
     * @param Device $device
     * @param int $tries
     */
    public function __construct(Device $device, int $tries)
    {
        $this->device = $device;
        $this->tries = $tries;
    }
}
