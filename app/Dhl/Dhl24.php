<?php

namespace App\Dhl;

use App\Dhl\API\Dhl24WebApiClient;
use App\Dhl\AuthData;
use App\Dhl\Structures\ShipmentFullData;

class Dhl24
{
    /**
     * @var Dhl24WebApiClient
     */
    private $client;

    /**
     * @var \App\Dhl\AuthData
     */
    private $authData;

    /**
     * Dhl24 constructor.
     *
     * @param \App\Dhl\AuthData $authData
     */
    public function __construct(AuthData $authData)
    {
        $this->client =  new Dhl24WebApiClient();
        $this->authData = $authData;
    }

    /**
     * @param $shipmentDate
     * @param $order
     */
    public function createShipments($shipmentDate, $order)
    {
        $shipments = new ShipmentFullData();
        $params = [
            'authData' => $this->authData->getAuthData(),
            'shipments' => $shipments->getShipmentFullData($shipmentDate, $order)
        ];
        return $this->client->createShipments($params);
    }
}
