<?php

namespace App\Dpd;

class Services
{
    /**
     * @param $order
     *
     * @return array[]
     */
    private function services($order)
    {
        $services = [
            'cod' => [
                'amount' => convertToTotalPrice($order->total_price),
                'currency' => $order->currency
            ]
        ];

        return $services;
    }

    /**
     * @param $order
     *
     * @return array[]
     */
    public function getServices($order): array
    {
        return $this->services($order);
    }
}
