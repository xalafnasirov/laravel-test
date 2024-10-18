<?php

namespace App\Livewire\Services;

use App\Jobs\GetCartDetail;
use App\Jobs\SendOrderConfirmationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class Checkout extends Component
{

    public function render()
    {
        return view('livewire.services.checkout');
    }

    protected $listeners = [
        "on_retrieve_cart" => "get_cart"
    ];

    public $cart_product_count = 0;

    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $selected_region = 28;
    public $village;
    public $street;
    public $zipcode;
    public $apartment;
    public $all_region;
    public $cart;
    public $total_price;
    public $payment_type;
    public $selected_payment_type;
    public $show = 1;

    public $sub_total = 0;
    public $discount = 0;
    public $shipping_fee = 0;

    public function mount()
    {
        $this->all_region = $this->get_all_region();
        $this->payment_type = $this->get_all_payment_type();
        dispatch(new GetCartDetail());
        $cart_details = Cache::get('cart_details');
        if (!$cart_details) {
            $this->cart_product_count = 0;
            return;
        }

        $this->cart = $cart_details['cart'];

        $this->sub_total = $cart_details['cart_price'];

        $this->shipping_fee = 0;
        $this->discount = 0; 

        $this->discount = ($this->sub_total * $this->discount) / 100;


        $this->total_price = $this->sub_total - $this->discount + $this->shipping_fee;
    }

    public function handleUpdatedCartData()
    {
        dd($this->sub_total); // Now this will have the correct value
    }

    protected $rules = [
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'selected_region' => 'required|integer',
        'email' => 'required|email|min:3|max:255',
        'phone' => "required|integer|min:99999999|max:9999999999",
        'selected_payment_type' => 'required|integer'
    ];

    protected function messages()
    {
        return [
            'firstname.required' => 'The first name field is mandatory.',
            'lastname.required' => 'The last name field is required.',
            'selected_region.required' => 'Please select a region.',
            'selected_region.integer' => 'The region must be a valid integer.',
            'village.string' => 'The village must be a valid string.',
            'village.min' => 'The village name must be at least 2 characters long.',
            'street.string' => 'The street must be a valid string.',
            'street.min' => 'The street name must be at least 2 characters long.',
            'zipcode.required' => 'The zipcode field is required.',
            'zipcode.min' => 'The zipcode must be at least 3 characters long.',
            'email.required' => 'We need to know your email address!',
            'email.email' => 'Bu address artıq',
            'email.unique' => 'This email address is already registered.',
            'phone.required' => 'The phone number is required.',
            'phone.unique' => 'This phone number is already in use.',
        ];
    }

    public function updatedFirstname()
    {
        $this->validateOnly('firstname');
    }

    public function updatedLastname()
    {
        $this->validateOnly(field: 'lastname');
    }

    public function updatedSelectedRegion()
    {
        $this->validateOnly('selected_region');
    }

    public function updatedVillage()
    {
        $this->validateOnly('village');
    }

    public function updatedStreet()
    {
        $this->validateOnly('street');
    }

    public function updatedZipCode()
    {
        $this->validateOnly('zipcode');
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function updatedPhone()
    {
        if (strlen($this->phone) > 10) {
            $this->phone = substr($this->phone, 0, 9);
            return;
        }
        $this->validateOnly('phone');
    }

    public function submit()
    {
        $this->validate();

        if (!DB::table('payment_type')->where('id', $this->selected_payment_type)->exists()) {
            $this->selected_payment_type = 1;
        }

        if (!DB::table('region')->where('id', $this->selected_region)->exists()) {
            $this->selected_region = 28;
        }

        $order_id = null;

        $order_key = $this->generate_order_key();

        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();
            // DB::table('user_order')->insert([
            //     'user_id'=> $user_id,
            //     'phone'=>$this->phone,
            //     'email'=> $this->email,
            //     'order_key'=> Str::uuid(),
            //     'payment_type_id'=> $this->selected_payment_type,
            //     'user_paid_price'=> $this->cart_price,
            // ]);

        } else {

            $cart_token = Session::get('cart_token');
            if ($cart_token !== null) {
                $order_id =  DB::table('user_order')->insertGetId([
                    'phone' => "+994{$this->phone}",
                    'email' => $this->email,
                    'authentication' => Str::uuid(),
                    'order_key' => $order_key,
                    'payment_type_id' => $this->selected_payment_type,
                    'user_paid_price' => $this->total_price,
                    'region_id' => $this->selected_region,
                    'guest_token' => $cart_token,
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'subtotal' => $this->sub_total,
                    'discount' => $this->discount,
                    'shipping_fee' => $this->shipping_fee,
                ]);

                foreach ($this->cart as $single) {
                    DB::table('cart')
                        ->where([
                            'guest_token' => $cart_token,
                            'id' => $single->id,
                        ])
                        ->update([
                            'status' => 'purchased',
                            'order_id' => $order_id
                        ]);
                }
            } else {
                return;
            }
        }

        dispatch(new SendOrderConfirmationEmail(['to'=>$this->email, 'order_key'=> $order_key, 'order_id'=> $order_id]));

        redirect()->route('services.order.confirmation', ['order_id' => $order_id]);
    }

    public function send_email() {}

    public function generate_order_key()
    {
        // ORD-47384738
        $prefix = "ORD-";

        $random_num = str_pad(mt_rand(0, 99999999), 8, "0", STR_PAD_LEFT);

        $order_key = $prefix . $random_num;

        if (DB::table('user_order')->where('order_key', $order_key)->exists()) {
            $this->generate_order_key();
        } else {
            return $order_key;
        }
    }

    public function get_all_region()
    {
        return DB::table('region')->get();
    }

    public function get_all_payment_type()
    {
        return DB::table('payment_type')->get();
    }



    function get_cart($cart, $cart_product_count, $cart_price)
    {
        $this->cart = $cart;
        $this->cart_product_count = $cart_product_count;
        $this->sub_total = $cart_price;

        dd($this->sub_total);
    }
}
