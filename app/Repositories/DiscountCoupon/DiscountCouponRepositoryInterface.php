<?php

namespace  App\Repositories\DiscountCoupon;

use App\Models\DiscountCoupon;

interface DiscountCouponRepositoryInterface
{
    public function getAll();

    /**
     * @return mixed
     */
    public function getOne($coupon_id);

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params);

    /**
     * @param String $coupon_uuid
     * @param Int $product_id
     * @return mixed
     */
    public function getMatchingCouponByUuid(String $coupon_uuid, Int $product_id);

    /**
     * @param String $coupon_code
     * @return mixed
     */
    public function getDiscountCouponByCode(String $coupon_code);

    /**
     * @param String $coupon_code
     * @param Int $product_id
     * @return mixed
     */
    public function getMatchingCouponByCode(String $coupon_code, Int $product_id);

    /**
     * @param String $coupon_uuid
     * @return mixed
     */
    public function getDiscountCouponByUuid(String $coupon_uuid);

    /**
     * @param \App\Models\DiscountCoupon $discountCoupon
     * @param array            $params
     *
     * @return mixed
     */
    public function update(DiscountCoupon $discountCoupon, array $params);

    /**
     * @param \App\Models\DiscountCoupon $discountCoupon
     *
     * @return mixed
     */
    public function delete(DiscountCoupon $discountCoupon);
}
