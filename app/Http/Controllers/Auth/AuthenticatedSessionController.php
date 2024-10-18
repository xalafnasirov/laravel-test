<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $client_ip = $request->getClientIp();
        $user_agent = $request->userAgent();
        $device_info = "{$ip} {$client_ip} {$user_agent}";

        DB::table('user_otp')
        ->where('user_id', '=', Auth::user()->id)
        ->update([
            'is_verified'=> 0
        ]);

        DB::table("user_login_devices")
        ->where([
            'user_id'=>Auth::user()->id,
            'device'=>$device_info,
        ])->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }
}
