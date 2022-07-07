<?php
namespace App\Observers;

use App\Models\DiscountCoupon;
use Illuminate\Support\Str;

class DiscountCouponObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param DiscountCoupon $discountCoupon
     * @return void
     */
    public function creating(DiscountCoupon $discountCoupon)
    {
        $discountCoupon->uuid = Str::uuid();
    }
}
