<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LayingCycleAlert extends Notification
{
    use Queueable;

    protected $henStock;

    public function __construct($henStock)
    {
        $this->henStock = $henStock;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Hens Nearing End of Laying Cycle')
            ->line("The hens at branch {$this->henStock->branch->name} (Breed: {$this->henStock->breed}) are reaching the end of their laying cycle.")
            ->action('Check Hen Stock', url('/henstocks'))
            ->line('Consider replacing them soon.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Hens at {$this->henStock->branch->name} (Breed: {$this->henStock->breed}) are reaching end of laying cycle.",
        ];
    }
}
