<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class StripTabsNotification extends Notification
{
    use Queueable;
    protected Collection $strips;
    protected Collection $ads;
    protected Collection $alerts;
    protected Collection $news;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($strips, $ads, $alerts, $news)
    {
        $this->strips = $strips;
        $this->ads = $ads;
        $this->alerts = $alerts;
        $this->news = $news;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->markdown('mail.strip_tabs', ['new_strips' => $this->strips, 'new_ads' => $this->ads, 'alerts' => $this->alerts, 'news' => $this->news]);
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
