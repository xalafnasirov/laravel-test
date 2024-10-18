<?php

namespace App\Http\Middleware;

use App\Jobs\SendOtpEmail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;



class OtpVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $client_ip = $request->getClientIp();
        $user_agent = $request->userAgent();
        $device_info = "{$ip} {$client_ip} {$user_agent}";


        if (Auth::guard('web')->check()) {

            $id = $request->user()->id;

            $otp = DB::table('user_otp')
                ->where([
                    'user_id' => $id,
                ])
                ->first();

            if (!DB::table('user_login_devices')
                ->where([
                    'user_id' => $id,
                    'device' => $device_info
                ])->exists()) {
                DB::table('user_login_devices')
                    ->insert([
                        'user_id' => $id,
                        'device' => $device_info,
                    ]);
            }


            $new_otp_code = $this->generate_otp();

            $otp_type = null;

            if ($request->user()->email) {
                $otp_type = 'email';
            } else if ($request->user()->phone)
                $otp_type = 'whatsapp';
            else {
                return response("Email yaxud telefon nömrəsi qeyd edin");
            }

            if ($otp) {
                if ($otp->is_verified === 1) {

                    if (!DB::table('user_login_devices')
                        ->where([
                            'user_id' => $id,
                            'device' => $device_info
                        ])->exists()) {

                        DB::table('user_login_devices')
                            ->insert([
                                'user_id' => $id,
                                'device' => $device_info,
                            ]);
                    } else {

                        return $next($request);
                    }
                }

                if ($otp->expires_at > Carbon::now('Asia/Baku')->toDateTimeString()) {
                    if ($otp_type === 'email') {
                        return redirect()->route('otp_verification.notice');
                    }
                } else {
                    if ($otp_type === 'email') {

                        DB::table('user_otp')
                            ->where([
                                'user_id' => $id,
                            ])
                            ->update([
                                'otp'=>Hash::make($new_otp_code),
                            ]);

                        dispatch(new SendOtpEmail($new_otp_code, $request->user()->email));
                        return redirect()->route('otp_verification.notice');
                    }
                }
            } else {
                DB::table('user_otp')
                    ->insert([
                        'user_id' => $id,
                        'otp' => Hash::make($new_otp_code),
                        'expires_at' => Carbon::now('Asia/Baku')->addMinutes(5),
                        'is_verified' => 0,
                    ]);

                dispatch(new SendOtpEmail($new_otp_code, $request->user()->email));
                return redirect()->route('otp_verification.notice');
            }
        }

        return $next($request);
    }

    public function generate_otp()
    {
        return rand(100000, 999999);
    }
}
