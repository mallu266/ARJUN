<?php

namespace ARJUN\ADMIN\NOTIFICATIONS;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class USERREGISTRATION extends Notification implements ShouldQueue {

    use Queueable;

    protected $user, $password, $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $password, $token) {
        $this->user = $user;
        $this->password = $password;
        $this->token = $token;
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
        $url = url('password/setpassword/' . base64_encode($this->user->email) . '/' . $this->token);
        return (new MailMessage())
                        ->greeting('Hello!')
                        ->line('Please find Temp Password ' . $this->password . ' And Set password')
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
