<?php

namespace App\Services;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Class CurlService
 * @package App\Services
 */
class CurlService
{
    protected $client;

    /**
     * CurlService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function post(string $url, array $data): ResponseInterface
    {
        return $this->client->post($url, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data)
        ]);
    }
}
