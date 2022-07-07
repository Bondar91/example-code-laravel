<?php

namespace  App\Repositories\Order;

use App\Enums\DiscountCouponTypeEnum;
use App\Enums\OrderTypeEnum;
use App\Enums\PaymentMethodTypeEnum;
use App\Enums\PaymentStatusTypeEnum;
use App\Models\Product;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * OrderRepository constructor.
     * @param Order $order
     */
    public function __construct()
    {
        $this->order = new Order();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->order
            ->query()
            ->with(['user', 'products'])
            ->sortable(['order_date' => 'desc'])
            ->paginate(100);
    }

    /**
     * @param $params
     *
     * @return mixed
     */
    public function getOrdersByFilter($params)
    {
        return $this->order
                    ->query()
                    ->filter($params)
                    ->tab($params)
                    ->sortable(['order_date' => 'desc'])
                    ->paginate(100);
    }

    /**
     * @param $params
     *
     * @return mixed
     */
    public function getOrdersToExport($params)
    {
        return $this->order
            ->query()
            ->filter($params)
            ->tab($params)
            ->sortable()
            ->paginate(2500);
    }

    /**
     * @param Int $order_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getOne(Int $order_id)
    {
        return $this->order
                    ->query()
                    ->find($order_id);
    }

    /**
     * @param String $order_uuid
     * @return Builder|Model|object|null
     */
    public function getOrderByUuid(String $order_uuid)
    {
        return $this->order
            ->query()
            ->with(['user', 'user.address', 'user.billing', 'products', 'inposts'])
            ->where('uuid', $order_uuid)
            ->first();
    }

    /**
     * @param array $params
     *
     * @return \App\Models\Order
     */
    public function create(array $params)
    {
        return $this->order
                    ->create($params);
    }

    /**
     * @param Order $order
     * @param array $params
     *
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function update(Order $order, array $params)
    {
        $this->order
                ->query()
                ->find($order->id)
                ->update($params);
    }



    /**
     * @param \App\Models\Order $order
     * @param \App\Models\Product $product
     * @param $coupon
     * @return void
     */
    public function attachProduct(Order $order, Product $product, $coupon)
    {
        $price = $coupon !== null ? ($coupon->type === DiscountCouponTypeEnum::NORMAL ? convertToTotalPrice($coupon->value) : floor(convertToTotalPrice($product->price - ($product->price * ($coupon->value/10000))))): convertToTotalPrice($product->price);
        $priceProduct = convertToChangePrice($price);

        $order->products()->attach($product->id,[
            'price' => $priceProduct,
            'quantity' => $product->quantity,
        ]);
    }

    public function attachProductByAdmin(Order $order, Product $product, $data)
    {
        $order->products()->attach($product->id,[
            'price' => $data['price_product'],
            'quantity' => $data['quantity'],
        ]);
    }

    /**
     * @param Order $order
     */
    public function detachProduct(Order $order)
    {
        $order->products()->detach();
    }

    public function updateBilling($order_id, $billing_id)
    {
        $this->order->find($order_id)->update([
            'billing_id' => $billing_id
        ]);
    }

    /**
     * @param Order $order
     *
     * @return mixed
     * @throws \Exception
     */
    public function delete(Order $order)
    {
        return $this->order
                    ->query()
                    ->find($order->id)
                    ->delete();
    }

    /**
     * @param array $idsToDelete
     * @return int
     */
    public function deleteMany(array $idsToDelete)
    {
        return Order::destroy($idsToDelete);
    }
}
