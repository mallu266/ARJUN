<?php

namespace ARJUN\ADMIN\NOTIFICATIONS;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class USERREGISTRATION extends Notification implements ShouldQueue {

    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user) {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
//        return ['mail'];
        return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
//        $url = url('/invoice/' . $this->invoice->id);
        $url = url('/');
        return (new MailMessage())
                        ->greeting('Hello!')
                        ->line('You have been registered!')
                        ->action('Login', $url)
                        ->subject('Test')
//                        ->error()
                        ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
                //
        ];
    }

}
