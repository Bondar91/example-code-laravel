<?php

namespace App\Dpd;

use App\Enums\PaymentMethodTypeEnum;
use DPD\Services\DPDService;
use App\Dpd\Sender;
use App\Dpd\Parcels;
use App\Dpd\Receiver;
use App\Dpd\Services;

class Dpd
{
    /**
     * Dpd constructor.
     */
    public function __construct()
    {
        $this->sender = new Sender();
        $this->parcels = new Parcels();
        $this->receiver = new Receiver();
        $this->services = new Services();
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
     * @param $order
     *
     * @return object|\StdClass
     */
    public function sendPackage($order)
    {
        $productShorName = $this->getProductShortName($order);

        $dpd = new DPDService();
        $dpd->setSender($this->sender->getSenderAddressData($order));
        $parcels = $this->parcels->getParcels($order);
        $receiver = $this->receiver->getReceiver($order);
        $services = ((int)$order->payment_method === PaymentMethodTypeEnum::CASH_ON_DELIVERY) ? $this->services->getServices($order) : [];
        $ref = $productShorName . "-" . $order->id;

        $sendPackage = $dpd->sendPackage($parcels, $receiver, 'SENDER', $services, $ref);

        return $sendPackage;
    }

    /**
     * @throws \Exception
     */
    public function generateLabels($package_id)
    {
        $dpd = new DPDService();
        $sender = $this->sender->getSenderAddressData();

        return $dpd->generateSpeedLabelsByPackageIds($package_id, $sender);
    }

    /**
     * @throws \Exception
     */
    public function generateProtocol($package_id)
    {
        $dpd = new DPDService();
        $sender = $this->sender->getSenderAddressData();

        return $dpd->generateProtocolByPackageIds($package_id, $sender);
    }
}
