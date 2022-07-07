<?php

return (object) [
    'fid' => env('DPD_FID'),
    'username' => \Config::get('dpd.username'),
    'password' => \Config::get('dpd.password'),
    'wsdl' => \Config::get('dpd.wsdl'),
    'lang_code' => 'PL',
    'api_version' => 4,
    'debug' => false,
    'log_errors' => false,
    'log_path' => 'logs',
    'timezone' => 'Europe/Warsaw'
];
