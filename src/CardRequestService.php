<?php


namespace Marijana\Restpackage;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CardRequestService extends validateRequest implements IRequestService
{
    private $modelName = 'card';
    private $client;
    protected string $api_key;
    protected string $method;
    protected string $url;
    protected mixed $param;
    public function validateRequest($modelName, $method, $endpointName, $param=null)
    {
        $requestCheck = new validateRequest();
       return $this->url = $requestCheck->validate($modelName, $method, $endpointName, $param);
    }

    public function makeRequest($method, $url, $param=null)
    {
        try{
                $client = new Client();
                $api_key = config('auth_app.AUTH-KEY');
                $headers = [
                    'AUTH-KEY' => $api_key
                ];
             $response = $client->request($method, $url, [
                    'json' => $param,
                    'headers' => $headers,
                    'verify'=>false,
                ]);
            $responseBody = json_decode($response->getBody());
            return compact('responseBody');
            }catch(RequestException $ex){
              if($ex->hasResponse()){
                  if($ex->getResponse()->getStatusCode()){
                      echo "Got response code" . $ex->getResponse()->getStatusCode();
                  }
              }else{
                  throw new \Exception("Request malformd." .$ex->getMessage());
              }
        }

    }
}