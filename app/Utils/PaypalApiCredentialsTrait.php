<?php

namespace App\Utils;

use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

trait PaypalApiCredentialsTrait
{
    /**
     * @var $_api_context
     */
    private $_api_context;

    public function setCredentials()
    {
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
}
