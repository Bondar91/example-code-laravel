<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static NEW()
 * @method static static IN_PROGRESS()
 * @method static static FINISHED()
 */
final class OrderStatusTypeEnum extends Enum implements LocalizedEnum
{
    const NEW = 0;
    const IN_PROGRESS = 1;
    const FINISHED = 2;
}
