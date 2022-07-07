<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DiscountCouponsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountCouponUpdateOrCreateRequest;
use App\Models\DiscountCoupon;
use App\Models\Product;
use App\Services\DiscountCouponService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DiscountCouponController extends Controller
{
    /**
     * @var \App\Services\DiscountCouponService
     */
    protected $discountCouponService;
    protected $productService;

    /**
     * DiscountCouponController constructor.
     *
     * @param \App\Services\DiscountCouponservice $discountCouponService
     * @param ProductService $productService
     */
    public function __construct(DiscountCouponService $discountCouponService, ProductService $productService)
    {
        $this->discountCouponService = $discountCouponService;
        $this->productService = $productService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $discountCoupons = $this->discountCouponService->getDiscountCoupons();

        return view('admin.discountCoupons.index', ['discountCoupons' => $discountCoupons]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $products = $this->productService->getProducts();

        return view('admin.discountCoupons.create', ['products' => $products]);
    }

    /**
     * @param DiscountCoupon $discountCoupon
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(DiscountCoupon $discountCoupon)
    {
        $products = $this->productService->getProducts();

        return view('admin.discountCoupons.edit', ['discountCoupon' => $discountCoupon, 'products' => $products]);
    }

    /**
     * @param DiscountCouponUpdateOrCreateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(DiscountCouponUpdateOrCreateRequest $request)
    {
        $this->discountCouponService->create($request);

        return redirect('admin/discount-coupons')->with('success', 'Kupon dodany pomyślnie');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function generateCouponsView()
    {
        $products = $this->productService->getProducts();

        return view('admin.discountCoupons.generateCode', ['products' => $products]);
    }

    /**
     * @param DiscountCouponUpdateOrCreateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function generateCoupons(Request $request)
    {

        switch ($request->input('action')) {
            case 'coupon-export':
                $discountCoupons = $this->discountCouponService->generateCoupons($request);

                return Excel::download(new DiscountCouponsExport($discountCoupons), 'Kupony-' . now() . '.xls');
        }

        return redirect('admin/discount-coupons')->with('success', 'Kupony wygenerowane pomyślnie');
    }

    /**
     * @param DiscountCouponUpdateOrCreateRequest $request
     * @param DiscountCoupon $discountCoupon
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(DiscountCouponUpdateOrCreateRequest $request, DiscountCoupon $discountCoupon)
    {
        $this->discountCouponService->update($request, $discountCoupon);

        return redirect('admin/discount-coupons')->with('success', 'Kupon zaktualizowany pomyślnie');
    }

    /**
     * @param DiscountCoupon $discountCoupon
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(DiscountCoupon $discountCoupon)
    {
        $this->discountCouponService->delete($discountCoupon);

        return redirect('admin/discount-coupons')->with('success', 'Kupon usunięty pomyślnie');
    }
}
