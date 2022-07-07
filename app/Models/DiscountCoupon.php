<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'product_id',
        'code',
        'value',
        'limitation',
        'active',
        "type"
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
