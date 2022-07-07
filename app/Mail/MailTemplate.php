<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTemplate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $mailType;
    protected $data;
    protected $views = [
        0 => 'emails.orderConfirmation',
        1 => 'emails.paymentConfirmation',
        2 => 'emails.shipmentCashOnDeliveryConfirmation',
        3 => 'emails.shipmentConfirmation',
        4 => 'emails.invoice',
    ];

    /**
     * Create a new message instance.
     *
     * @param $mailType
     * @param $data
     */
    public function __construct($mailType, $data)
    {
        $this->mailType = $mailType;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view($this->views[$this->mailType])
            ->with(['data' => $this->data]);
    }
}
