<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCompleted extends Notification
{
    use Queueable;
    public $product;
    public $disableProduct;
    public $inventory_product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($product, $disableProduct, $inventory_product)
    {
        $this->product = $product;
        $this->disableProduct = $disableProduct;
        $this->inventory_product = $inventory_product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if (isset($product)){
            return [
                'data' => 'A product Added to Inventory'
            ];
        }
        elseif(isset($disableProduct)){
            return [
                'data' => 'A product moved from Disable List'
            ];
        }
        else{
            return [
                'data' => 'A product moved Disabled'
            ];
        }

    }
}
