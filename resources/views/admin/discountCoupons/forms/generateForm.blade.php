<div class="m-20 mb-0">
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/3 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="code">
                Typ kuponu
            </label>
            <select class="type-coupon block appearance-none w-full bg-gray-200 text-gray-700 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline focus:bg-white mb-3" name="type">
                @foreach(\App\Enums\DiscountCouponTypeEnum::asArray() as $discountCouponType)
                    <option value="{{ $discountCouponType }}" {{ old('type') == $discountCouponType || isset($discountCoupon) && old('type', $discountCoupon->type) == $discountCouponType ? 'selected' : ''}}>{{ \App\Enums\DiscountCouponTypeEnum::getDescription($discountCouponType) }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 products">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product_id">
                Produkt
            </label>
            <select class="block appearance-none w-full bg-gray-200 text-gray-700 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline focus:bg-white mb-3" name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ isset($discountCoupon) ? $product->id == $discountCoupon->product_id ? 'selected' : '' : null }}>{{ $product->name . ' - ' . $product->quantity . 'szt. ' . $product->currency }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="value">
                Ilość
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="value" name="quantity" type="number">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="value">
                Wartość
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="value" name="value" type="number" value="{{ old('value', isset($discountCoupon) ? convertToTotalPrice($discountCoupon->value) : null) }}">
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.type-coupon').on('change', function(){
                let typeCoupon = $('.type-coupon option:checked').val();

                if(parseInt(typeCoupon) === {{ App\Enums\DiscountCouponTypeEnum::PERCENTAGE }}) {
                    $('.products').addClass('hidden');
                } else {
                    $('.products').removeClass('hidden');
                }
            })

        });
    </script>
@endpush
