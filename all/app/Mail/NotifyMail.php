<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $product;
    public $inventory_product;
    public $disableProduct;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $product, $inventory_product, $disableProduct)
    {
        $this->details = $details;
        $this->product = $product;
        $this->inventory_product = $inventory_product;
        $this->disableProduct = $disableProduct;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from ParallaxLogic')->view('emails.notify');
    }
}
