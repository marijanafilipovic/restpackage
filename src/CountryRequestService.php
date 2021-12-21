<?php


namespace Marijana\Restpackage;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use phpDocumentor\Reflection\Types\Null_;


class CountryRequestService extends validateRequest implements IRequestService
{
protected $client;
protected $api_key;
protected $method;
protected $url;
protected $param;
protected $modelName = 'country';
//check endpoint from confing by endpointName and create endpointUrl

    /**
     * @param $modelName
     * @param $method
     * @param $endpointName
     * @param null $param
     * @return string
     */
    public function validateRequest($modelName, $method, $endpointName, $param=null)
    {
        $requestCheck = new validateRequest();
        return $this->url = $requestCheck->validate($modelName, $method, $endpointName, $param);
    }

    /**
     * @param $method
     * @param $url
     * @param null $param
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function makeRequest($method, $url, $param=null)
    {
     //check response

        $client = new Client();
        $api_key = config('auth_app.AUTH-KEY');
        $headers = [
            'AUTH-KEY' => $api_key
        ];
        //$params = [];
        $response = $client->request($method, $this->url, [
            //'json' => $params,
            'headers' => $headers,
            'verify'=>false,
        ]);
        if(!$response){
            return "Bad request response.";
        }
        try{
        $responseBody = json_decode($response->getBody());
        $response->getStatusCode();


               return compact('responseBody');
           }catch(ClientException $e){
        return $response->getStatusCode();
            //  redirect('/');

        }

}

}