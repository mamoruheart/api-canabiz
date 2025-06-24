<?php

namespace App\Notifications;

use App\Mail\PharmaciesSyncReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class PharmaciesSyncNotification extends Notification
{
    use Queueable;

    protected Collection $new;
    protected Collection $rem;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newPharmacies, $removedPharmacies)
    {
        $this->new = $newPharmacies;
        $this->rem = $removedPharmacies;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->markdown('mail.pharmacies_sync_report', ['newPharmacies' => $this->new, 'removedPharmacies' => $this->rem]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
