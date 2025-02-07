<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LowStockAlert extends Notification
{
    use Queueable;

    protected $stock;

    public function __construct($stock)
    {
        $this->stock = $stock;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Send via email and database notification
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Low Stock Alert')
            ->line("The stock for {$this->stock->item_type} is low ({$this->stock->quantity} left).")
            ->action('Check Stock', url('/stocks'))
            ->line('Please restock as soon as possible.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Low stock: {$this->stock->item_type} ({$this->stock->quantity} left)",
        ];
    }
}
