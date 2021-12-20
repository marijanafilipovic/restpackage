<?php


namespace Marijana\Restpackage;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use phpDocumentor\Reflection\Types\Null_;


class CountryRequestService implements IRequestService
{
protected $client;
public function makeRequest($method, $endpointName, $param)
{
    //check endpoint from confing by endpointName and create endpointUrl

    if($endpointName == ''){
        $url='https://restcountries.com/v2/all';
    }else{
        $endUrl = config('endpoints.'.$endpointName);
        //  dd($endUrl);

        // $param = 150;
        if(strpos($endUrl, ':id') !==false && (!empty($param))){
            $endUrl = str_replace(':id', $param,$endUrl);
        }
        $baseURL = env('APP_URL');
        $url = $baseURL.$endUrl;
        //dd($url);
    }
    //check response
    try{
        $client = new Client();
        $api_key = config('auth_app.AUTH-KEY');
        // dd($api_key);
        $headers = [
            'AUTH-KEY' => $api_key
        ];
        //$params = [];
        $response = $client->request($method, $url, [
            //'json' => $params,
            'headers' => $headers,
            'verify'=>false,
        ]);
        if(!$response){
            return "Bad request response.";
        }
        $responseBody = json_decode($response->getBody());
        return compact('responseBody');
    }catch(ClientException $ex){
        dd($ex->getMessage());
    }
}

}