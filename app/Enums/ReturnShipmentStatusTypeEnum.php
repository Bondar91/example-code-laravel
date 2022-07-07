<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static NOT_RETURNED_SHIPMENT()
 * @method static static RETURNED_SHIPMENT()
 */
final class ReturnShipmentStatusTypeEnum extends Enum implements LocalizedEnum
{
    const NOT_RETURNED_SHIPMENT = 0;
    const RETURNED_SHIPMENT = 1;
}
