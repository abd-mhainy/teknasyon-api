<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Repositories\DeviceRepositoryInterface;
use App\ValueObject\ReportPayload;

/**
 * Class ReportsController
 * @package App\Http\Controllers
 */
class ReportsController extends Controller
{
    /**
     * @param ReportRequest $request
     * @param DeviceRepositoryInterface $deviceRepository
     * @return array
     */
    public function getReport(ReportRequest $request, DeviceRepositoryInterface $deviceRepository): array
    {
        if (!$request->isValidDateRange()) {
            return ['status' => 'error', 'message' => 'please check the date range you entered'];
        }

        return $deviceRepository->generateReport(
            new ReportPayload([
                'appId' => $request->input('appId', ''),
                'os' => $request->input('os', ''),
                'startDate' => $request->input('startDate', ''),
                'endDate' => $request->input('endDate', ''),
            ])
        );
    }
}
