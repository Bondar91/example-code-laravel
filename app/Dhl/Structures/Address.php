<?php

namespace App\Dhl\Structures;

class Address
{
    private $senderAddressData = [
        'country' => 'PL',
        'name' => 'CompanyNane',
        'postalCode' => 'xxxxx',
        'city' => 'cityName',
        'street' => 'steet',
        'houseNumber' => '2',
        'contactEmail' => 'test@example.com',
    ];

    /**
     * @param $order
     * @param $productsShortName
     *
     * @return array
     */
    private function receiverAddressData($order, $productsShortName)
    {
        $receiverAddressData = [
            'country' => $order->user->address->country_iso,
            'name' => $order->user->name . ' ' . $order->user->last_name,
            'postalCode' => removeCharactersFromString($order->user->address->post_code),
            'city' => $order->user->address->city,
            'street' => $order->user->address->street,
            'houseNumber' => $order->user->address->house_number ?: null,
            'apartmentNumber' => $order->user->address->flat_number ?: null,
            'contactPerson' => $order->id . '-' . $productsShortName,
            'contactEmail' => $order->user->email,
            'contactPhone' => $order->user->phone
        ];

        return $receiverAddressData;
    }

    /**
     * @param $order
     * @param $productsShortName
     *
     * @return array
     */
    public function getReceiverAddressData($order, $productsShortName): array
    {
        return $this->receiverAddressData($order, $productsShortName);
    }

    /**
     * @return string[]
     */
    public function getSenderAddressData(): array
    {
        return $this->senderAddressData;
    }
}
