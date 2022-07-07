<?php

namespace App\Services;

use App\Enums\DiscountCouponTypeEnum;
use App\Http\Requests\DiscountCouponUpdateOrCreateRequest;
use App\Models\DiscountCoupon;
use App\Repositories\DiscountCoupon\DiscountCouponRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscountCouponService
{
    /**
     * @var $discountCouponRepository
     */
    protected $discountCouponRepository;

    /**
     * DiscountCouponService constructor.
     */
    public function __construct()
    {
        $this->discountCouponRepository = new DiscountCouponRepository();
    }

    /**
     * @return Collection|\Illuminate\Database\Eloquent\Builder[]
     */
    public function getDiscountCoupons()
    {
        return $this->discountCouponRepository->getAll();
    }

    /**
     * @param $coupon_id
     * @return mixed
     */
    public function getDiscountCoupon($coupon_id)
    {
        return $this->discountCouponRepository->getOne($coupon_id);
    }

    /**
     * @return mixed
     */
    public function getDiscountCouponByUuid(String $coupon_uuid)
    {
        return $this->discountCouponRepository->getDiscountCouponByUuid($coupon_uuid);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function checkIfCouponMatchByUuid($coupon_uuid, $product_id)
    {
        $coupon = $this->discountCouponRepository->getDiscountCouponByUuid($coupon_uuid);
        if(isset($coupon) && $coupon->type === DiscountCouponTypeEnum::NORMAL) {
            return $this->discountCouponRepository->getMatchingCouponByUuid($coupon_uuid, $product_id);
        } else {
            return $this->discountCouponRepository->getMatchingCouponByUuid($coupon_uuid, null);
        }
    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|int|object
     */
    public function checkIfCouponMatchByCode($coupon_code, $product_id)
    {
        $coupon = $this->discountCouponRepository->getDiscountCouponByCode($coupon_code);

        if(isset($coupon) && $coupon->type === DiscountCouponTypeEnum::NORMAL) {
            return $this->discountCouponRepository->getMatchingCouponByCode($coupon_code, $product_id);
        } else {
            return $this->discountCouponRepository->getMatchingCouponByCode($coupon_code, null);
        }
    }

    /**
     * @param DiscountCouponUpdateOrCreateRequest $request
     */
    public function create(DiscountCouponUpdateOrCreateRequest $request)
    {
        $this->discountCouponRepository->create($this->discountCouponTableData($request));
    }

    /**
     * @param DiscountCouponUpdateOrCreateRequest $request
     */
    public function generateCoupons(Request $request)
    {
        $quantity = $request->input('quantity');
        $cupons = [];
        for($i=0; $i<$quantity; $i++) {
            $coupons[] = $this->discountCouponRepository->create($this->discountCouponGenerateData($request));
        }

        return $coupons;
    }

    /**
     * @param DiscountCouponUpdateOrCreateRequest $request
     * @param DiscountCoupon $discountCoupon
     */
    public function update(DiscountCouponUpdateOrCreateRequest $request, DiscountCoupon $discountCoupon)
    {
        $this->discountCouponRepository->update($discountCoupon, $this->discountCouponTableData($request));
    }

    /**
     * @param \App\Models\DiscountCoupon $discountCoupon
     */
    public function updateLimitation(DiscountCoupon $discountCoupon)
    {
        $this->discountCouponRepository->update($discountCoupon, $this->discountCouponLimitationData());
    }

    /**
     * @param DiscountCoupon $discountCoupon
     */
    public function delete(DiscountCoupon $discountCoupon)
    {
        $this->discountCouponRepository->delete($discountCoupon);
    }

    /**
     * @param $request
     * @return array
     */
    protected function discountCouponTableData($request): array
    {
        $couponType = $request->input('type');
      
        return [
            'product_id' => (int)$couponType === DiscountCouponTypeEnum::NORMAL ? $request->input('product_id') : null,
            'code' => $request->input('code'),
            'value' => convertToChangePrice($request->input('value')),
            'limitation' => $request->input('limitation'),
            'active' => (int)$request->input('active'),
            'type' => $request->input('type')
        ];
    }
}
