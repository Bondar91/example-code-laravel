<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static NOT_SENDED()
 * @method static static SENDED()
 */
final class InvoiceStatusTypeEnum extends Enum implements LocalizedEnum
{
    const NOT_SENDED = 0;
    const SENDED = 1;
}
