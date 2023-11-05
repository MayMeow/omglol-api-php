<?php
//declare(strict_types=1);
// Your code goes here

namespace MayMeow\Omglol\Services\Http;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmgLolClient implements OmgLolClientInterface
{
    protected HttpClientInterface $client;

    protected string $baseUrl = 'https://api.omg.lol';

    protected array $defaultHeaders = [
        'Content-Type' => 'application/json'
    ];

    public function __construct(
        protected string $token,
    )
    {
        $this->client = HttpClient::create();
        $this->token = $token;
    }

    public function get(string $url)
    {
        $url = $this->baseUrl . $url;
        return $this->client->request('GET', $url, $this->_updateHeaders());
    }

    protected function _updateHeaders(): array
    {
        $this->defaultHeaders['Authorization'] = 'Bearer ' . $this->token;

        return [
            'headers' => $this->defaultHeaders
        ];
    }
}