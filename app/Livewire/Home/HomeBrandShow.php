<?php

namespace App\Livewire\Home;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeBrandShow extends Component
{

    public $car_brand;
    public $tire_brand;

    public function get_car_brand() {
        $this->car_brand = DB::table('car_brand')->get();
    }

    public function get_tire_brand() {
        $this->tire_brand = DB::table('tire_brand')->get();
    }


    public function mount() {

        $this->get_car_brand();
        $this->get_tire_brand();
    }

    public function render()
    {
        return view('livewire.home.home-brand-show');
    }
}
