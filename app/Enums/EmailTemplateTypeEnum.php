<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static EMAIL_ORDER_CONFIRMATION()
 * @method static static EMAIL_PAYMENT_CONFIRMATION()
 * @method static static EMAIL_SHIPMENT_CASH_ON_DELIVERY_CONFIRMATION()
 * @method static static EMAIL_SHIPMENT_CONFIRMATION()
 * @method static static EMAIL_INVOICE()
 */
final class EmailTemplateTypeEnum extends Enum implements LocalizedEnum
{
    const EMAIL_ORDER_CONFIRMATION = 0;
    const EMAIL_PAYMENT_CONFIRMATION = 1;
    const EMAIL_SHIPMENT_CASH_ON_DELIVERY_CONFIRMATION = 2;
    const EMAIL_SHIPMENT_CONFIRMATION = 3;
    const EMAIL_INVOICE = 4;
}
