<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    protected $registered;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $registered)
    {
        $this->registered = $registered;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = Auth::user();
        return $this->from(['address' => 'mathieu@cheshire.chat', 'name' => 'Mathieu Brossard'])
                    ->view('mail.user.registered');
    }
}
