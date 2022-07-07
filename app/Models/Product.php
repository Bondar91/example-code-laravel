<?php

namespace App\Models;

use App\Services\DiscountCouponService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['*'];

    protected $fillable = [
        'name',
        'short_name',
        'quantity',
        'price',
        'last_price',
        'currency',
        'quantity'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('price', 'quantity')
            ->withTimestamps();
    }

    public function calculateDifferenceBetweenProductAndCoupon()
    {
        $couponService = new DiscountCouponService();

        $coupon = $couponService->getPopupCoupon($this->id);

        return convertToTotalPrice($this->price - $coupon->value);
    }
}
