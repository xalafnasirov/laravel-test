<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    // get
    public function notice()
    {

        if (DB::table('user_otp')
            ->where([
                'user_id' => Auth::user()->id,
                'is_verified' => 1
            ])->exists()
        ) {
            return redirect()->route('dashboard');
        }

        return view('auth.verify-otp');
    }

    // post
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ], [
            'otp.required' => 'OTP düzgün deyil',
            'otp.digits' => 'OTP düzgün deyil',
        ]);

        $user_otp = DB::table('user_otp')
            ->where([
                'user_id' => Auth::user()->id,
            ])->first()->otp;

        if (Hash::check($request->otp, $user_otp)) {
            DB::table('user_otp')
                ->where([
                    'user_id' => Auth::user()->id,
                ])
                ->update([
                    'is_verified' => 1
                ]);

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'otp' => 'OTP düzgün deyil',
            ])->withInput();
        }
    }


    // function ensureIsNotRateLimited(): void
    // {
    //     if (RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
    //         $seconds = RateLimiter::availableIn($this->throttleKey());

    //         throw ValidationException::withMessages([
    //             'email' => trans('auth.throttle', [
    //                 'seconds' => $seconds,
    //                 'minutes' => ceil($seconds / 60),
    //             ]),
    //         ]);
    //     }

    //     // event(new Lockout($this));

    //     $seconds = RateLimiter::availableIn($this->throttleKey());

    //     throw ValidationException::withMessages([
    //         'email' => trans('auth.throttle', [
    //             'seconds' => $seconds,
    //             'minutes' => ceil($seconds / 60),
    //         ]),
    //     ]);
    // }

    // /**
    //  * Get the rate limiting throttle key for the request.
    //  */
    // function throttleKey(): string
    // {
    //     return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    // }
}
