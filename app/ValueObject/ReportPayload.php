<?php

namespace App\ValueObject;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class ReportPayload
 * @package App\ValueObject
 */
class ReportPayload implements Arrayable
{
    protected $appId;
    protected $os;
    protected $startDate;
    protected $endDate;

    /**
     * RegisterPayload constructor.
     * @param array $content
     */
    public function __construct(array $content)
    {
        $this->appId = $content['appId'];
        $this->os = $content['os'];
        $this->startDate = $content['startDate'];
        $this->endDate = $content['endDate'];
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId === '' ? null : $this->appId;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os === '' ? null : $this->os;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate === '' ? null : Carbon::createFromFormat('d-m-Y', $this->startDate);
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate === '' ?
            Carbon::now()->toDateString() :
            Carbon::createFromFormat('d-m-Y', $this->endDate);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'appId' => $this->getAppId(),
            'os' => $this->getOs(),
            'startDate' => $this->getStartDate(),
            'endDate' => $this->getEndDate(),
        ];
    }
}
