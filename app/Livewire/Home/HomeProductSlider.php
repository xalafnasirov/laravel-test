<?php

namespace App\Livewire\Home;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeProductSlider extends Component
{


    public $filtered_home_car_part;
    public $filtered_tire;
    public $product_image;

    public function get_car_part() {

        $this->filtered_home_car_part =  DB::table("product")
        ->join("car_part_detail", "product.detail_id", "=", "car_part_detail.id")
        ->join("car_brand", "car_part_detail.brand_id", "=", "car_brand.id")
        ->join("car_part_category", "car_part_detail.category_id", "=", "car_part_category.id")
        ->join("car_part_sub_category", "car_part_detail.sub_category_id", "=", "car_part_sub_category.id")
        ->select([
            'product.*',
            'car_brand.name as brand',
            'car_part_category.name as category',
            'car_part_sub_category.name as part_name',
            'car_part_detail.price as price'
        ])
        ->where('product.active', '=', 1)
        ->limit(10)
        ->get();

        if ($this->filtered_home_car_part) {
            foreach ($this->filtered_home_car_part as $product) {
                $this->product_image[$product->id] =  DB::table('product_image')->where('product_id', $product->id)->select('image')->first();
            }
        }
    }

    public function get_tire() {

        $filtered_home_tires = DB::table("product")
        ->join("tire_detail", "product.detail_id", "=", "tire_detail.id")
        ->join("tire_brand", "tire_detail.brand_id", "=", "tire_brand.id")
        ->select([
            'product.*',
            'tire_brand.name as brand',
            'tire_detail.price as price'
        ])
        ->where([
            'product.active'=> 1,
            'product.product_type_id'=> 2
            ])
        ->limit(10)
        ->get();

    }

    public function mount() {
        $this->get_car_part();
        $this->get_tire();
    }

    public function render()
    {
        return view('livewire.home.home-product-slider');
    }
}
