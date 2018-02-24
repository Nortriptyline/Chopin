<?php
namespace App\Factories;

use App\Password_init;
use Carbon\Carbon;

class Password_initFactory
{
    public static function build($email, $lifetime = null)
    {
        $lifetime = $lifetime ?? 3;
        return Password_init::firstOrCreate(
            ['email' => $email],
            ['token' => uniqid(), 'revoked_at' => Carbon::now()->adddays($lifetime)]
        );
    }
}