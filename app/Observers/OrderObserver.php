<?php
namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Str;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param Order $order
     * @return void
     */
    public function creating(Order $order)
    {
        $order->uuid = Str::uuid();
    }
}
