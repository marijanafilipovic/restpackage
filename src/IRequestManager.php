<?php


namespace Marijana\Restpackage;


interface IRequestManager
{
public function make($name):IRequestService;
}