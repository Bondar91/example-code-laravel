<?php

namespace App\Utils;

use App\Enums\PaymentStatusTypeEnum;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use App\Services\SalesManagoService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait UpdateStatusPaymentTrait
{
    /**
     * @var $orderRepository
     */
    protected $orderRepository;

    /**
     * UpdateStatusPaymentTrait constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Order $order
     * @param null              $transactionId
     * @param null              $transactionDate
     */
    public function setPaid(Order $order, $transactionId = null, $transactionDate = null)
    {
        try {
            $this->orderRepository->update($order, $this->paramsUpdate($transactionId, $transactionDate));
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @param $transactionId
     * @param $transactionDate
     *
     * @return array
     */
    protected function paramsUpdate($transactionId, $transactionDate): array
    {
        return [
            'payment_status' => PaymentStatusTypeEnum::PAID,
            'payment_date' => Carbon::createFromFormat('Y-m-d H:i:s', $transactionDate),
            'transaction_id' => $transactionId
        ];
    }
}
