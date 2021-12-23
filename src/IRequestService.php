<?php


namespace Marijana\Restpackage;


interface IRequestService
{
public function makeRequest(string $method, string $url, mixed $param);
public function validateRequest(string $modelName, string $method, string $endpointName, mixed $param);
}