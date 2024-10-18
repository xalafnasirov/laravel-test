<?php

namespace App\Livewire\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;


class UserDashboard extends Component
{

    public $user;
    public $address;

    public function get_user()
    {
        if (Auth::guard('web')->check()) {
            $id = Auth::guard('web')->id();
            $this->user = DB::table('users')->where('id', $id)->first();
            $this->address = DB::table('address')->where('user_id', $id)->first();
        } else {
            return;
        }
    }

    public $all_region;

    public function get_all_region()
    {
        $this->all_region = DB::table('region')->get();
    }

    // Head pages
    public $panel;
    public $pages = [
        'user-info' => 'İstifadəçi Məlumatları',
        'orders'=>'Maşın Hissəsi Sifarişləri',
        'requests'=>'Avtomobil Sifarişləri',
        'account'=>'Hesab',
    ];
    public $title;

    public function to_page($panel)
    {
        redirect()->route('dashboard.go', ['panel' => $panel]);
    }


    // Update user info
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $region_id;
    public $street;
    public $zipcode;

    protected $rules = [
        'firstname' => 'string|max:255',
        'lastname' => 'string|max:255',
        'email' =>  'string|email|max:255',
        'phone' => 'string|min:9',
        'region_id' => 'integer',
        'street' =>  'string|max:255',
    ];

    public function updatedFirstname()
    {
        $this->updateUserInfo('address', 'firstname', $this->firstname);
    }

    public function updatedLastname()
    {
        $this->updateUserInfo('address', 'lastname', $this->lastname);
    }

    public function updatedEmail()
    {
        $this->updateUserInfo('users', 'email', $this->email);
    }

    public function updatedPhone()
    {
        $this->updateUserInfo('users', 'phone', $this->phone);
    }

    public function updatedRegionId()
    {
        $this->updateUserInfo('address', 'region_id', $this->region_id);
    }

    public function updatedStreet()
    {
        $this->updateUserInfo('address', 'street', $this->street);
    }

    public function updatedZipcode()
    {
        $this->updateUserInfo('address', 'zipcode', $this->zipcode);
    }

    public function updateUserInfo($table, $col, $val)
    {

        $this->validateOnly($col);

        $id_col = 'id';

        $id_col = ($table == 'address') ? 'user_id' : 'id';

        DB::table($table)
            ->where($id_col, $this->user->id)
            ->update([
                $col => $val
            ]);
    }

    public function check_page($panel): bool {
        foreach ($this->pages as $key=>$val) {
            if ($panel == $key) {
                return true;
            }
        }

        return false;
    }

    public function mount($panel = null)
    {
        if ($panel === null) {
            $panel = 'user-info';
        }


        if (!$this->check_page($panel)) {
            $panel = 'user-info';
        }

        $this->panel = $panel;
        
        // if (!isset($this->pages[$this->panel])) {
        //     $this
        // }
        $this->title = $this->pages[$this->panel];

        $this->get_user();
        $this->get_all_region();

        $this->firstname = $this->address->firstname;
        $this->lastname = $this->address->lastname;
        $this->email =  $this->user->email;
        $this->phone =  $this->user->phone;
        $this->region_id = $this->address->region_id;
        $this->street =  $this->address->street;
        $this->zipcode =  $this->address->zipcode;
    }


    public function render()
    {
        return view('livewire.account.user-dashboard');
    }
}
