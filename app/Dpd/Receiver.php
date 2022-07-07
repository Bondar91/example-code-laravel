<?php

namespace App\Dpd;

class Receiver
{
    /**
     * @param $order
     *
     * @return array
     */
    private function receiver($order)
    {
        $flat_number = $order->user->address->flat_number !== null ? '/' . $order->user->address->flat_number : '';

        $receiver = [
            'name' => $order->user->name . ' ' . $order->user->last_name,
            'address' => $order->user->address->street . ' ' . $order->user->address->house_number . $flat_number,
            'city' => $order->user->address->city,
            'postalCode' => removeCharactersFromString($order->user->address->post_code),
            'countryCode' => $order->user->address->country_iso,
            'phone' => str_replace('+', '', $order->user->phone),
            'email'=> $order->user->email,
        ];

        return $receiver;
    }

    /**
     * @param $order
     *
     * @return array
     */
    public function getReceiver($order): array
    {
        return $this->receiver($order);
    }
}
