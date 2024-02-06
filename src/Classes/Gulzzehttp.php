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
        $status=Cache::get('gulzze');
       if ($status){
           $status=Cache::get('gulzze');
           if ($status === 'enable'){
               return true;
           }
           elseif($status === 'disable'){
               if (!app()->runningInConsole()) {
                   abort(403);
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
                Cache::put('gulzze','disable',3600);
                abort(419);
            }
            else{
                Cache::put('gulzze','disable',3600);
                return false;
            }

        } else {
            Cache::put('gulzze','enable',3600);
            return true;
        }
    }
}
