<?php

namespace App\Services;

use GuzzleHttp\Client;

class GeoService
{
    protected $client;
    protected $baseUrl;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->baseUrl = config('geo-api.base_api');
    }

    public function getGeoData(array $params)
    {
        $url = $this->baseUrl . '/espacializarlinha';
        $response = $this->client->request('GET', $url, ['query' => $params]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody(), true);
        }

        return null;
    }
}

