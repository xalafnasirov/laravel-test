<?php

namespace App\Livewire\Account;

use App\Jobs\SendEmailVerificationEmail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class RegisterProcess extends Component
{
    public $login_type = ['email', 'whatsapp', 'google'];
    public $tab = 'login-select';
    public $tabs = [
        'select' => 'register-select',
        'email' => 'register-email',
        'whatsapp' => 'register-whatsapp',
        'google' => 'register-google',
        'email-verify' => 'register-email-verify',
    ];

    public function open_tab($open_tab)
    {
        $this->dispatch('tab-changed', ['close_tab' => $this->tab, 'open_tab' => $open_tab, 'base_url' => 'register']);
        $this->tab = $open_tab;
    }


    public function email_login()
    {
        // get request values
    }

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $password_verification;

    public function email_register()
    {
        $this->validate(
            [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255',
                // 'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'password' => ['required', Rules\Password::defaults()],
                'password_verification' => ['required_with:password', 'same:password', 'min:6']
            ],
            [
                'firstname.required' => 'Adınızı qeyd edin',
                'firstname.string' => 'Adınızı qeyd edin',
                'firstname.max' => 'Adınız limit sayını keçmişdir',
                'lastname.required' => 'Soyadınızı qeyd edin',
                'lastname.string' => 'Soyadınızı qeyd edin',
                'lastname.max' => 'Soyaddınız limit sayını keçmişdir',
                'email.required' => 'Emailinizi qeyd edin',
                'email.string' => 'Emailinizi qeyd edin',
                'email.lowercase' => 'Emailiniz ancaq balaca hərflərlə yazılmalıdır',
                'email.max' => 'Emailiniz uzunluğu limit sayını keçmişdir',
                'email.unique' => 'Qeyd etdiyiniz email artıq mövcuddur! Daxil ol?',
                'password.required' => 'Şifrə təyin edin',
                'password_verification.required_with' => 'Şifrə qeyd edin',
                'password_verification.min' => 'Şifrələr uyğun gəlmir',
            ]
        );

        $user = User::create([
            // 'firstname' => $this->firstname,
            // 'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $id = Auth::user()->id;


        DB::table('address')
        ->insert([
            'user_id'=>$id,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
        ]);

        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $client_ip = request()->getClientIp();
        $user_agent = request()->userAgent();
        $device_info = "{$ip} {$client_ip} {$user_agent}";



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

        DB::table('user_otp') 
            ->insert([
                'user_id' => $id,
                'otp' => '647263',
                'expires_at' => Carbon::now('Asia/Baku'),
                'is_verified' => 1,
            ]);


        $this->send_verification_email();

        $this->open_tab($this->tabs['email-verify']);
    }

    public function to_login()
    {
        redirect()->route('login');
    }

    public function mount($tab = null)
    {

        if ($tab === null) {
            $tab = $this->tabs['select'];
        }

        if (!array_key_exists($tab, $this->tabs)) {
            return redirect()->route('register.go', ['tab' => 'select']);
        }

        $this->tab = $this->tabs[$tab];
    }

    public $link = 'http://google.com';
    public $verification_email;

    public function send_verification_email()
    {

        if (request()->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        request()->user()->sendEmailVerificationNotification();
    }

    public function render()
    {
        if (Auth::guard('web')->check()) {
            if (Auth::user()->email) {
                $this->verification_email = Auth::user()->email;
            }
        }
        return view('livewire.account.register-process');
    }
}
