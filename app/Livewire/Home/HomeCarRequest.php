<?php

namespace App\Livewire\Home;

use App\Jobs\SendRequestEmail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeCarRequest extends Component
{

    public $selected_brand;
    public $selected_year = null;
    public $selected_fuel_type = null;
    public $customer_name;
    public $customer_phone;
    public $request_sent = false;
    public $processing = false;

    protected $rules = [
        "selected_brand"=>'integer',
        "customer_name"=>'string|min:2',
        "customer_phone"=>'string|min:9',
    ];

    protected function messages()
    {
        return [
            'selected_brand.integer' => 'Zəhmət olmasa marka seçin.',
            'customer_name.string' => 'Adınızı qeyd edin.',
            'customer_phone.string' => 'Nömrənizi qeyd edin.',
            'customer_name.min' => 'Adınızı qeyd edin.',
            'customer_phone.min' => 'Nömrənizi qeyd edin.',
        ];
    }


    public function submit() {

        $this->validate();

        if (!DB::table('car_brand')->where('id', $this->selected_brand)->exists()) {
            return;
        }

        $request_id = DB::table('request')->insertGetId([]);

        DB::table('request_detail')
        ->insert([
            'request_id'=>$request_id,
            'phone'=>$this->customer_phone,
            'customer'=>$this->customer_name,
            'brand_id'=>$this->selected_brand,
            'year'=>$this->selected_year,
            'fuel_type'=>$this->selected_fuel_type
        ]);

        $this->processing = true;

        dispatch(new SendRequestEmail());

        $this->request_sent = true;
    }

    public $brand;

    public function get_brand() {
        $this->brand = DB::table('car_brand')->get();
    }


    public function mount() {
        $this->get_brand();
    }

    public function render()
    {
        return view('livewire.home.home-car-request');
    }
}
