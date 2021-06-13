<?php

namespace App\Listeners;

use App\Events\StatusChanged;
use App\Repositories\SettingsRepositoryInterface;
use App\Services\CurlService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;

class StatusChangedReport
{
    const RETRY_LIMIT = 5;

    protected $curlService;
    protected $settingsRepo;

    /**
     * StatusChangedReport constructor.
     * @param CurlService $curlService
     * @param SettingsRepositoryInterface $settingsRepo
     */
    public function __construct(CurlService $curlService, SettingsRepositoryInterface $settingsRepo)
    {
        $this->curlService = $curlService;
        $this->settingsRepo = $settingsRepo;
    }

    /**
     * @param StatusChanged $event
     * @return void
     * @throws GuzzleException
     */
    public function handle(StatusChanged $event)
    {
        $callbackUrl = $this->settingsRepo->getSettingValueByName('callback_url');
        $response = $this->curlService->post(
            $callbackUrl,
            ['deviceId' => $event->device->id, 'appId' => $event->device->appId, 'status' => $event->device->status]
        );

        if ($response->getStatusCode() !== Response::HTTP_ACCEPTED
            && $response->getStatusCode() !== Response::HTTP_OK
        ) {
            if ($event->tries < self::RETRY_LIMIT) {
                StatusChanged::dispatch($event->device, ++$event->tries);
            }
        }
    }
}
