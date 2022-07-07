<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static NOT_SHIPPED()
 * @method static static SHIPPED()
 */
final class ShipmentStatusTypeEnum extends Enum implements LocalizedEnum
{
    const NOT_SHIPPED = 0;
    const SHIPPED = 1;
}
