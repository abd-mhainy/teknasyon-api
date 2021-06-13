<?php

namespace App\ValueObject;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class PurchasePayload
 * @package App\ValueObject
 */
class PurchasePayload implements Arrayable
{
    protected $clientToken;
    protected $receipt;

    /**
     * PurchasePayload constructor.
     * @param array $content
     */
    public function __construct(array $content)
    {
        $this->clientToken = $content['clientToken'];
        $this->receipt = $content['receipt'];
    }

    /**
     * @return mixed
     */
    public function getClientToken()
    {
        return $this->clientToken;
    }

    /**
     * @return mixed
     */
    public function getReceipt()
    {
        return $this->receipt;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'clientToken' => $this->getClientToken(),
            'receipt' => $this->getReceipt(),
        ];
    }
}
