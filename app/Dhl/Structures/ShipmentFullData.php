<?php

namespace App\Dhl\Structures;

use App\Dhl\Structures\Address;
use App\Dhl\Structures\Piece;
use App\Dhl\Structures\PaymentData;
use App\Dhl\Structures\ServiceDefinition;
use Illuminate\Support\Str;

class ShipmentFullData
{
    private $address;
    private $piece;
    private $paymentData;
    private $serviceDefinition;

    public function __construct()
    {
        $this->address = new Address();
        $this->piece = new Piece();
        $this->paymentData = new PaymentData();
        $this->serviceDefinition = new ServiceDefinition();
    }

    /**
     * @param $order
     *
     * @return string
     */
    private function getProductShortName($order)
    {
        $products = '';
        foreach($order->products as $product)
        {
            $products .= $product->short_name . '-' . $product->pivot->quantity;
        }

        return $products;
    }

    /**
     * @param $shipmentDate
     * @param $order
     *
     * @return array
     */
    public function getShipmentFullData($shipmentDate, $order)
    {
        $productsShortName = $this->getProductShortName($order);

        $data['item'] = [
            'shipper' => $this->address->getSenderAddressData(),
            'receiver' => $this->address->getReceiverAddressData($order, $productsShortName),
            'pieceList' => [
                'item' => $this->piece->getPieceDefinition()
            ],
            'payment' => $this->paymentData->getPaymentData(),
            'service' => $this->serviceDefinition->getServiceDefinition($order),
            'shipmentDate' => $shipmentDate,
            'content' => $productsShortName,
            'comment' => Str::limit($order->id . '-' . $order->notes, 90, '...'),
            'skipRestrictionCheck' => true,
            'reference' => $order->id . '-' . $productsShortName
        ];

        return $data;
    }
}
