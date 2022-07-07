<?php

namespace App\Services;

use App\Mail\EventMailSender;
use App\Models\Order;

class EmailService
{
    /**
     * @param Order $order
     */
    public function sendOrderConfirmation(Order $order)
    {
        $mail = new EventMailSender(call_user_func('App\Enums' . '\EmailTemplateTypeEnum::EMAIL_ORDER_CONFIRMATION_' . $order->site_lang)->value);
        $mail->sendMail($order, [
            'order' => $order,
            'user' => $order->user,
        ]);
    }

    /**
     * @param Order $order
     */
    public function sendPaymentConfirmation(Order $order)
    {
        $mail = new EventMailSender(call_user_func('App\Enums' . '\EmailTemplateTypeEnum::EMAIL_PAYMENT_CONFIRMATION_' . $order->site_lang)->value);
        $mail->sendMail($order, [
            'order' => $order,
            'user' => $order->user,
        ]);
    }

    /**
     * @param Order $order
     */
    public function sendShipmentCashOnDeliveryConfirmation(Order $order)
    {
        $mail = new EventMailSender(call_user_func('App\Enums' . '\EmailTemplateTypeEnum::EMAIL_SHIPMENT_CASH_ON_DELIVERY_CONFIRMATION_' . $order->site_lang)->value);
        $mail->sendMail($order, [
            'order' => $order,
            'user' => $order->user,
        ]);
    }

    /**
     * @param Order $order
     */
    public function sendShipmentConfirmation(Order $order)
    {
        $mail = new EventMailSender(call_user_func('App\Enums' . '\EmailTemplateTypeEnum::EMAIL_SHIPMENT_CONFIRMATION_' . $order->site_lang)->value);
        $mail->sendMail($order, [
            'order' => $order,
            'user' => $order->user,
        ]);
    }

    /**
     * @param Order $order
     */
    public function sendInvoice(Order $order)
    {
        $mail = new EventMailSender(call_user_func('App\Enums' . '\EmailTemplateTypeEnum::EMAIL_INVOICE_' . $order->site_lang)->value);
        $mail->sendMail($order, [
            'user' => $order->user,
        ]);
    }


}
