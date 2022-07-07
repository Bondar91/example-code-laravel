<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static CASH_ON_DELIVERY()
 * @method static static TRANSFER()
 * @method static static PAYPAL()
 * @method static static TPAY()
 * @method static static STRIPE()
 * @method static static BLIK()
 */
final class PaymentMethodTypeEnum extends Enum implements LocalizedEnum
{
    const CASH_ON_DELIVERY = 0;
    const TRANSFER = 1;
    const PAYPAL = 2;
    const TPAY = 3;
    const STRIPE = 4;
    const BLIK = 5;
}
