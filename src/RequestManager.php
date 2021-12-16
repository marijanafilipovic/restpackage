<?php


namespace Marijana\Restpackage;

use Marijana\Restpackage\IRequestService;
use Marijana\Restpackage\CountryRequestService;
use Marijana\Restpackage\CardRequestService;
use Illuminate\Support\Arr;

class RequestManager
{
    private $modelName = [];
    private $app;
    public function __construct( $modelName)
    {
        $this->modelName= $modelName;
        // $this->app = $app;
    }
    public function make($name):IRequestService{
        $service = Arr::get($this->modelName, $name);
        if($service){
            return $service;
        }
        $createMethod = 'create'.ucfirst($name).'RequestService';
        if(!method_exists($this, $createMethod)){
            throw new \Exception("Request is not supported.");
        }
        $service = $this->{$createMethod}();
        $this->modelName[$name] = $service;
        return $service;
    }
    private function createCountryRequestService():CountryRequestService
    {
        $service = new CountryRequestService();
        return $service;
    }
    private function createCardRequestService():CardRequestService
    {
        $service = new CardRequestService();
        return $service;
    }

}