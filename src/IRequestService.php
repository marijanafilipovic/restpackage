<?php


namespace Marijana\Restpackage;


interface IRequestService
{
public function makeRequest($method, $url, $param);
}