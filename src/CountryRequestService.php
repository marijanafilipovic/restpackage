<?php


namespace Marijana\Restpackage;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class CountryRequestService extends validateRequest implements IRequestService
{
    private $modelName = 'country';
    private $client;
    protected string $api_key;
    protected string $method;
    protected string $url;
    protected mixed $param;

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