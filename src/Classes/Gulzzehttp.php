<?php

namespace Packages\Gulzzehttp\Classes;

use Cryptommer\Smsir\Smsir;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class Gulzzehttp
{
    public static function use(): Gulzzehttp
    {
        return new static();
    }


    public function get(string $domain)
    {
        $client = new Client();

        $response = $client->get('https://rahatbet.com/api/gulzze-status/managment', [
            'query' => [
                'domain' => $domain,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);

        if (!isset($responseData['success']) || $responseData['success'] !== true) {
            abort(403, $responseData['message']);
        } else {
            return true;
        }
    }
}
