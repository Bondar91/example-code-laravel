<?php

namespace App\Dpd;

class Sender
{
    /**
     * @return array
     */
    private function sender()
    {
        $sender = [
            'fid' => 'FID' ,
            'name' => 'name',
            'company' => 'company',
            'address' => 'address',
            'city' => 'city',
            'postalCode' => 'postcode',
            'countryCode' => 'PL',
            'phone' => '+123123123',
        ];

        return $sender;
    }

    /**
     * @return string[]
     */
    public function getSenderAddressData(): array
    {
        return $this->sender();
    }
}
