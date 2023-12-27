<?php

namespace Packages\Gulzzehttp\Classes;

use Cryptommer\Smsir\Smsir;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
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
        if (Cache::get('domain')   === false){
            abort(419);
        }
        elseif (Cache::get('domain')   === true){
            return true;
        }
        $client = new Client();

        $response = $client->get('https://rahatbet.com/api/gulzze-status/managment', [
            'query' => [
                'domain' => $domain,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);

        if (!isset($responseData['success']) || $responseData['success'] !== true) {
            if (!$this->app->runningInConsole()) {
                Cache::put('domain',false,86400);
                abort(419);
            }
            else{
                return false;
            }

        } else {
            Cache::put('domain',true,86400);
            return true;
        }
    }
}
