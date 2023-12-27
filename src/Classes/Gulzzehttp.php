<?php

namespace Packages\Gulzzehttp\Classes;

use Cryptommer\Smsir\Smsir;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Gulzzehttp
{
    public static function use(): Gulzzehttp
    {
        return new static();
    }


    public function get(string $domain)
    {
        $response = Http::get('https://rahatbet.com/api/gulzze-status/managment', [
            'domain' => $domain,
        ]);
        if (!$response->json(['success']) == true) {
            abort('403',$response->json(['message']));
        } else {
            return true;
        }
    }
}
