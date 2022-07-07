<?php

namespace App\Dhl\Structures;

class PaymentData
{
    private function paymentData()
    {
        $params = [
            'paymentMethod' => 'BANK_TRANSFER',
            'payerType' => 'SHIPPER',
            'accountNumber' => env('DHL_SAP')
        ];

       return $params;
    }

    /**
     * @return array
     */
    public function getPaymentData(): array
    {
        return $this->paymentData();
    }
}
