<?php


namespace Marijana\Restpackage;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class CardRequestService extends validateRequest implements IRequestService
{
    protected $modelName = 'card';
    protected $client;
    protected $url;
    public function validateRequest($modelName, $method, $endpointName, $param=null)
    {
        $requestCheck = new validateRequest();
       return $this->url = $requestCheck->validate($modelName, $method, $endpointName, $param);
    }

    public function makeRequest($method, $url, $param=null)
    {
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
                 $responseBody = json_decode($response->getBody());
                return compact('responseBody');
            }catch(ClientException $ex){
           // return $responseBody = $ex->getResponse()->getBody(true);
                 return "TRY block did not make response ";
            }
        }

}