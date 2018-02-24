<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use App\Password_init;

class UserCreated extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $passwordInit;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Password_init $passwordInit)
    {
        $this->passwordInit = $passwordInit;
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
        ->subject(__('notifications/init_password.mail_object'))
        ->line(__('notifications/init_password.mail_details', ['date' => Carbon::parse($this->passwordInit->revoked_at)->formatLocalized('%d %B %Y')]))
        ->action(__('notifications/init_password.create_password'), url(config('app.url').route('password.show_init', $this->passwordInit->token, false)));
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


    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
