<?php

namespace App\ValueObject;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class RegisterPayload
 * @package App\ValueObject
 */
class RegisterPayload implements Arrayable
{
    const STARTED_STATUS = 'started';

    protected $uid;
    protected $appId;
    protected $os;
    protected $language;

    /**
     * RegisterPayload constructor.
     * @param array $content
     */
    public function __construct(array $content)
    {
        $this->uid = $content['uId'];
        $this->appId = $content['appId'];
        $this->os = $content['os'];
        $this->language = $content['language'];
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'uId' => $this->getUid(),
            'appId' => $this->getAppId(),
            'os' => $this->getOs(),
            'language' => $this->getLanguage(),
            'status' => self::STARTED_STATUS,
        ];
    }
}
