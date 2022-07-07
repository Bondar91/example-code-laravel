<?php

namespace App\Dpd;

class Parcels
{
    /**
     * @param $order
     *
     * @return array[]
     */
    private function parcels($order)
    {
        $parcels = [
            0 => [
                'content' => $order->notes,
                'customerData1' => 'Proszę uważać',
                'weight' => 1,
            ]
        ];

        return $parcels;
    }

    /**
     * @return array[]
     */
    public function getParcels($order): array
    {
        return $this->parcels($order);
    }
}
