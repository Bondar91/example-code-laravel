<?php

namespace App\Imports;

use App\Enums\PaymentStatusTypeEnum;
use App\Repositories\Order\OrderRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrdersPaymentStatusImport implements ToCollection
{
    /**
     * @param \Illuminate\Support\Collection $rows
     */
    public function collection(Collection $rows)
    {
        $orderRepository = new OrderRepository();

        foreach ($rows as $row)
        {
            $order = $orderRepository->getOne($row[0]);

            $orderRepository->update($order, [
                'payment_status' => PaymentStatusTypeEnum::PAID,
                'payment_date' => $row[1],
            ]);
        }
    }
}
