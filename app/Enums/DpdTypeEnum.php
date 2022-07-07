<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static LABEL()
 * @method static static PROTOCOL()
 * @method static static SHIPMENT_SEND()
 */
final class DpdTypeEnum extends Enum implements LocalizedEnum
{
    const LABEL = 0;
    const PROTOCOL = 1;
    const SHIPMENT_SHIPPED = 2;
}
