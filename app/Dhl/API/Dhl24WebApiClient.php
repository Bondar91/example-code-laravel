<?php

namespace App\Dhl\API;

use SoapClient;

class Dhl24WebApiClient extends SoapClient
{
    public function __construct()
    {
        $wsdl_link = \Config::get('dhl.wsdl');
        parent::__construct($wsdl_link);
    }
}
