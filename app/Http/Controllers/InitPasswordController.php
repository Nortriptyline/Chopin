<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Password_init;
use App\User;

class InitPasswordController extends Controller
{
    //
    public function index(Request $request, $token = null)
    {
        if (!($passwordInit = $this->getPasswordInit($token)) || Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.passwords.init', ['token' => $passwordInit->token, 'user' => $passwordInit->user]);
    }

    public function initialize(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $request->validate([
            'token' => [
                'required',
                'exists:password_inits',
                function ($attribute, $value, $fail) {
                    if (!Password_init::where([
                        ['token', '=', $value],
                        ['revoked_at', '>', Carbon::now()]
                    ])->exists()) {
                        return $fail('Token expired');
                    }
                },
            ],
            'password' => 'required|confirmed|min:6',
        ]);

        $passwordInit = $this->getPasswordInit($request->token);

        $user = $this->updatePassword($passwordInit->user, $request->password);
        $this->deletePasswordInit($passwordInit);

        $this->guard()->login($passwordInit->user);

        return redirect()->route('admin.');
    }

    protected function updatePassword(User $user, $password)
    {
        $user->active = 1;
        $user->password = bcrypt($password);
        return $user->save();
    }

    protected function deletePasswordInit(Password_init $passwordInit)
    {
        $passwordInit->delete();
    }

    protected function getPasswordInit($token)
    {
        return $passwordInit = Password_init::where([
            ['token', '=', $token],
            ['revoked_at', '>', Carbon::now()]
        ])->first();
    }
    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
