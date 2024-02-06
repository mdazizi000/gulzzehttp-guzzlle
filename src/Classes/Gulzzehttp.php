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
       if (Cache::has('status')){
           $status=Cache::get('status');
           if ($status === true){
               return true;
           }else{
               if (!app()->runningInConsole()) {
                   abort(419);
               }
               else{
                   return false;
               }
           }

       }


        $client = new Client();

        $response = $client->get('https://rahatbet.com/api/gulzze-status/managment', [
            'query' => [
                'domain' => $domain,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);

        if (!isset($responseData['success']) || $responseData['success'] !== true) {
            if (!app()->runningInConsole()) {
                Cache::put('status',false,3600);
                abort(419);
            }
            else{
                Cache::put('status',false,3600);
                return false;
            }

        } else {
            Cache::put('status',false,3600);
            return true;
        }
    }
}
