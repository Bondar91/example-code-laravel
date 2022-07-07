<?php

namespace App\Mail;

use App\Enums\EmailTemplateTypeEnum;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EventMailSender
{
    protected $mailType;

    /**
     * Create a new message instance.
     *
     * @param $mailType
     */
    public function __construct($mailType)
    {
        $this->mailType = $mailType;
    }

    /**
     * @param $order
     * @param $data
     */
    public function sendMail($order, $data)
    {
        $mail = new MailTemplate($this->mailType, $data);
        $mail->subject($this->getEmailSubject($order));
        Mail::to($order->user->email)->queue($mail);
    }

    /**
     * @param $order
     * @return string
     */
    private function getEmailSubject($order)
    {
        return EmailTemplateTypeEnum::getDescription($this->mailType);
    }


}
