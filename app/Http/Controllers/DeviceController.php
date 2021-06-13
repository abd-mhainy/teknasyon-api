<?php

namespace App\Http\Controllers;

use App\Services\PurchaseService;
use App\Services\DeviceService;
use App\ValueObject\PurchasePayload;
use App\ValueObject\RegisterPayload;
use Exception;
use Illuminate\Http\Request;

/**
 * Class DeviceController
 * @package App\Http\Controllers
 */
class DeviceController extends Controller
{
    /**
     * @param Request $request
     * @param DeviceService $deviceService
     * @return array|null
     */
    public function register(Request $request, DeviceService $deviceService)
    {
        $registerPayload = new RegisterPayload([
            'uId' => $request->input('uid'),
            'appId' => $request->input('appId'),
            'os' => $request->input('os'),
            'language' => $request->input('language'),
        ]);

        return $deviceService->registerDevice($registerPayload);
    }

    /**
     * @param Request $request
     * @param PurchaseService $purchaseService
     * @return array
     * @throws Exception
     */
    public function purchase(Request $request, PurchaseService $purchaseService): array
    {
        $purchasePayload = new PurchasePayload([
            'clientToken' => $request->input('clientToken'),
            'receipt' => $request->input('receipt'),
        ]);

        return $purchaseService->purchase($purchasePayload);
    }

    /**
     * @param Request $request
     * @param DeviceService $deviceService
     * @return array
     */
    public function check(Request $request, DeviceService $deviceService): array
    {
        return $deviceService->check($request->input('clientToken'));
    }
}
