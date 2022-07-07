<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static NORMAL()
 * @method static static PERCENTAGE()
 */
final class DiscountCouponTypeEnum extends Enum implements LocalizedEnum
{
    const NORMAL = 0;
    const PERCENTAGE = 1;
}
