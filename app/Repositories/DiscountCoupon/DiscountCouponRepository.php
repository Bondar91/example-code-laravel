<?php

namespace  App\Repositories\DiscountCoupon;

use App\Repositories\DiscountCoupon\DiscountCouponRepositoryInterface;
use App\Models\DiscountCoupon;

class DiscountCouponRepository implements DiscountCouponRepositoryInterface
{
    /**
     * @var DiscountCoupon
     */
    protected $discountCoupon;

    /**
     * DiscountCouponsRepository constructor.
     *
     */
    public function __construct()
    {
        $this->discountCoupon = new DiscountCoupon();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->discountCoupon
            ->with('product')
            ->orderBy('id','desc')
            ->paginate(100);
    }

    /**
     * @param $coupon_id
     * @return mixed
     */
    public function getOne($coupon_id)
    {
        return $this->discountCoupon->find($coupon_id);
    }

    /**
     * @param string $coupon_uuid
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getDiscountCouponByUuid(String|null $coupon_uuid)
    {
        return $this->discountCoupon
                    ->query()
                    ->where('uuid', $coupon_uuid)
                    ->first();
    }

    /**
     * @param String $coupon_code
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getDiscountCouponByCode(String $coupon_code)
    {
        return $this->discountCoupon
            ->query()
            ->where('code', $coupon_code)
            ->first();
    }

    /**
     * @param String $coupon_code
     * @param Int|null $product_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getMatchingCouponByCode(String $coupon_code, Int|null $product_id)
    {
        return $this->discountCoupon
                    ->query()
                    ->where('code', $coupon_code)
                    ->where('product_id', $product_id)
                    ->where('active', true)
                    ->first();
    }


    /**
     * @param $coupon_uuid
     * @param $product_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getMatchingCouponByUuid($coupon_uuid, $product_id)
    {
        return $this->discountCoupon
            ->query()
            ->where('uuid', $coupon_uuid)
            ->where('product_id', $product_id)
            ->where('active', true)
            ->first();
    }



    /**
     * @param array $params
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $params)
    {
        return $this->discountCoupon
                    ->query()
                    ->create($params);
    }

    /**
     * @param DiscountCoupon $discountCoupon
     * @param array            $params
     *
     * @return bool|int
     */
    public function update(DiscountCoupon $discountCoupon, array $params)
    {
        return $this->discountCoupon
                    ->query()
                    ->find($discountCoupon->id)
                    ->update($params);
    }

    /**
     * @param DiscountCoupon $discountCoupon
     *
     * @return mixed
     * @throws \Exception
     */
    public function delete(DiscountCoupon $discountCoupon)
    {
        return $this->discountCoupon
                    ->query()
                    ->find($discountCoupon->id)
                    ->delete();
    }
}
