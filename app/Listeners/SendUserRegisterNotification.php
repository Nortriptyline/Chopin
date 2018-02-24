<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Factories\Password_initFactory as Password_init;
use App\Events\UserRegistered;
use App\Notifications\UserCreated;

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
        $passwordInit = Password_init::build($event->user->email);
        $event->user->notify(new UserCreated($passwordInit));
    }
}
