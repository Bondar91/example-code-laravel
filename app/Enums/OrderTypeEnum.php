<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static MANUAL()
 * @method static static INTERNET()
 */
final class OrderTypeEnum extends Enum implements LocalizedEnum
{
    const MANUAL = 0;
    const INTERNET = 1;
}
