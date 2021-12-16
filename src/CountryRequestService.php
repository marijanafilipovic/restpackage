<?php


namespace Marijana\Restpackage;


use GuzzleHttp\Client;


class CountryRequestService implements IRequestService
{
protected $client;
public function makeRequest($method, $url, $param)
{
    $url='https://restcountries.com/v2/all';
    $client = new Client();
    $api_key = config('auth_app.AUTH-KEY');
    // dd($api_key);
    $headers = [
        'AUTH-KEY' => $api_key
    ];
    $params = [];
    $response = $client->request($method, $url, [
        //'json' => $params,
        'headers' => $headers,
        'verify'=>false,
    ]);
    $responseBody = json_decode($response->getBody());
    return compact('responseBody');
}
}