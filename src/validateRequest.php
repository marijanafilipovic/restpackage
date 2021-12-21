<?php


namespace Marijana\Restpackage;


class validateRequest
{
    protected $api_key;
    protected $method;
    protected $url;
    protected $param;

    /**
     * @param $modelName
     * @param $method
     * @param $endpointName
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function readEnd($modelName, $method, $endpointName)
    {
       return $point = config('endpoints.'.$modelName.'.'.$method .'.'.$endpointName.'');

    }
    /**
     * @param $method
     * @param $endpointName
     * @param $param
     * @return string
     */
    public function validate($modelName, $method, $endpointName, $param=null){
        if($this->getMethod($modelName, $method, $endpointName) == true ){
           return $this->getUrl($this->getMethod($modelName, $method, $endpointName));
        }else{
            return "Bad method and endpointName combination!";
        }
    }

    /**
     * @param $point
     * @param null $param
     * @return string
     * @description check endpoint regularity
     */
    public function getUrl($point, $param=null)
    {
            if(strpos($point, ':id') !==false && (!empty($param))){
                $endUrl = str_replace(':id', $param,$point);
            }elseif(strpos($point, ':id') !==false && (empty($param))){
                return "Missing param for ".$point;
            }else{
                $endUrl = $point;
            }
            $baseURL = env('APP_URL');
            $this->url = $baseURL.$endUrl;

        return $this->url;
    }

    /**
     * @param $method
     * @param $endpointName
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed|string
     */
    public function getMethod($modelName, $method, $endpointName)
    {
        $point = config('endpoints.'.$modelName.'.'.$method .'.'.$endpointName.'');

       if(!$point){
          return  "Bad method or endpointName";
       }else{
          return $point;
       }
    }

}