<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered as MailUserRegistered;

class SendUserRegisterNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Mail::to($event->user)->send(new MailUserRegistered($event->user));
    }
}
