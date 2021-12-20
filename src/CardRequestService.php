<?php


namespace Marijana\Restpackage;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class CardRequestService implements IRequestService
{
    protected $client;
    public function makeRequest($method, $endpointName=null, $param=null)
    {
        //check endpoint from confing by endpointName and create endpointUrl

        if($endpointName == ''){
            $url='https://countriesnow.space/api/v0.1/countries';
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

                $client = new Client();
                $api_key = config('auth_app.AUTH-KEY');
                // dd($api_key);
                $headers = [
                    'AUTH-KEY' => $api_key
                ];
                //$params = [];
        try{      $response = $client->request($method, $url, [
                    //'json' => $params,
                    'headers' => $headers,
                    'verify'=>false,
                ]);
                 $responseBody = json_decode($response->getBody());
                return compact('responseBody');
            }catch(ClientException $ex){
           // return $responseBody = $ex->getResponse()->getBody(true);
               // return "TRY block did not response ";
            }
        }

}