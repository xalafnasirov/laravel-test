<?php

namespace App\Livewire\Account;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class LoginProcess extends Component
{
    public $selected_login_type;

    public $login_type = ['email', 'whatsapp', 'google'];

    public function on_login_type_select($login_type)
    {
        if (!in_array($login_type, $this->login_type)) {
            return;
        }

        $this->selected_login_type = $login_type;

        // switch ($login_type) {
        //     case 'email':
        //         # code...
        //         break;
        //     case 'phone':
        //         # code...
        //         break;
        //     case 'google':
        //         # code...
        //         break;
        //     default:
        //         # code...
        //         break;
        // }
    }

    public function email_login() {

        // get request values
    }

    public function to_select_login_type() {
        $this->selected_login_type = null;
    }

    public function to_register() {
        redirect()->route('register');
    }

    public function mount() {}

    public function render()
    {
        return view('livewire.account.login-process');
    }
}
