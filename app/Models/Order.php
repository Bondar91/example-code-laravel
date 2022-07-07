<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;

class Order extends Model
{
    use HasFactory, SoftDeletes, Sortable, LogsActivity;

    protected static $logAttributes = ['*'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'number',
        'total_price',
        'currency',
        'type_order',
        'discount_coupon_id',
        'shipment_method_id',
        'payment_method',
        'order_status',
        'order_date',
        'notes',
        'transaction_id',
        'address_id',
        'billing_id',
    ];

    /**
     * @var string[]
     */
    protected $sortable = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('price', 'quantity')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipmentMethod()
    {
        return $this->belongsTo(ShipmentMethod::class);
    }

    /**
     * @param $query
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function scopeFilter($query, Request $request)
    {
        foreach( $request->query() as $key => $value )
        {
            if(!empty($value))
            {
                if(mb_strpos($key, 'start') !== false)
                {
                    $query->where(substr($key, 0, -6), '>=', $request->input($key) . ' 00:00:00');
                }

                if(mb_strpos($key, 'end') !== false)
                {
                    $query->where(substr($key, 0, -4), '<=', $request->input($key) . ' 23:59:59');
                }


                if ($key === 'type_order')
                {
                    $query->whereIn($key, $value);
                }

                if($key === 'product_name')
                {
                    $query->whereHas('products', function ($query) use ($value) {
                        $query->whereIn('products.name', $value);
                    });
                }


                if($key === 'phone_number')
                {
                    $query->whereHas('user', function ($query) use ($key, $value) {
                        if($key === 'phone_number')
                        {
                            $query->where('users.phone', $value);
                        }
                    });
                }
            }
        }

        return $query;
    }


    public function scopeTab($query, Request $request)
    {
        foreach( $request->query() as $key => $value )
        {
            if(!empty($value))
            {
                if($key === 'tab')
                {
                    if($value === 'empty')
                    {
                        $query->where('total_price', 0);
                    }

                    if($value === 'complete')
                    {
                        $query->where('total_price', '!=', 0);
                    }
                }

            }
        }

        return $query;
    }

    /**
     * @param $orders
     *
     * @return array
     */
    public function getTotalPriceWithCurrency($orders): array
    {
        $prices = array();
        foreach ($orders as $order)
        {
            $prices[$order['currency']][] = convertToTotalPrice($order['total_price']);
        }

        return $prices;
    }
}
