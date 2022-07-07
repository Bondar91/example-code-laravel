<?php

namespace App\Dhl\Structures;

use App\Enums\PaymentMethodTypeEnum;

class ServiceDefinition
{
    /**
     * @param $order
     *
     * @return array|int
     */
    private function serviceDefinition($order)
    {
        if($order->payment_method === PaymentMethodTypeEnum::CASH_ON_DELIVERY)
        {
            $serviceDefinition = [
                'product' => 'AH',
                'deliveryEvening' => false,
                'insurance' => true,
                'insuranceValue' => convertToTotalPrice($order->total_price),
                'predeliveryInformation' => true,
                'preaviso' => true,
                'collectOnDelivery' => true,
                'collectOnDeliveryValue' => convertToTotalPrice($order->total_price),
                'collectOnDeliveryForm' => 'BANK_TRANSFER',
            ];
        }
        else
        {
            $serviceDefinition = [
                'product' => 'AH',
                'deliveryEvening' => false,
                'insurance' => true,
                'insuranceValue' => convertToTotalPrice($order->total_price),
                'predeliveryInformation' => true,
                'preaviso' => true
            ];
        }

        return $serviceDefinition;
    }

    /**
     * @param $order
     *
     * @return array
     */
    public function getServiceDefinition($order): array
    {
        return $this->serviceDefinition($order);
    }
}
