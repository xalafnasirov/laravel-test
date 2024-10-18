<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class NavControl extends Component
{
    public $cart_product_count;
    public $cart_price;

    protected $listeners = [
        'on_update_cart' => 'update_cart',
        'on_get_cart' => 'get_cart',
    ];

    public function route($route)
    {
        if ($route === null) {
            return;
        }
        return redirect()->route($route);
    }

    public function get_cart()
    {

        $this->update_cart();

        $cart = null;
        $id = null;
        $id_column = '';

        if (Auth::guard('web')->check()) {
            $id = Auth::guard('web')->id();
            $id_column = 'user_id';
        } else {
            if (Session::has('cart_token')) {
                $id = Session::get('cart_token');
                $id_column = 'guest_token';
            } else {
                return;
            }
        }

        $cart = DB::table('cart')
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->join('car_part_detail', 'product.detail_id', '=', 'car_part_detail.id')
            ->join('car_brand', 'car_part_detail.brand_id', '=', 'car_brand.id')
            ->join('car_part_category', 'car_part_detail.category_id', '=', 'car_part_category.id')
            ->join('car_part_sub_category', 'car_part_detail.sub_category_id', '=', 'car_part_sub_category.id')
            ->select([
                'cart.*',
                'product.product_type_id',
                'product.detail_id',
                'car_part_detail.price as single_price',
                'car_brand.name as brand',
                'car_part_category.name as category',
                'car_part_sub_category.name as sub_category',
            ])
            ->where([
                "cart.{$id_column}" => $id,
                'cart.status' => 'active',
            ])
            ->get();

        $this->dispatch('on_retrieve_cart', $cart, $this->cart_product_count, $this->cart_price);
    }

    public function update_cart()
    {
        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();
            $this->cart_product_count = DB::table('cart')
                ->where([
                    'user_id' => $user_id,
                    'status' => 'active'
                ])
                ->count();
            $this->cart_price = DB::table('cart')
                ->where([
                    'user_id' => $user_id,
                    'status' => 'active'
                ])
                ->sum('price');
        } else {

            $cart_token = Session::get('cart_token');
            if (!$cart_token == null) {
                $this->cart_product_count = DB::table('cart')
                    ->where([
                        'guest_token' => $cart_token,
                        'status' => 'active'
                    ])
                    ->count();
                $this->cart_price = DB::table('cart')
                    ->where([
                        'guest_token' => $cart_token,
                        'status' => 'active'
                    ])
                    ->sum('price');
            } else {
                $this->cart_product_count = 0;
                $this->cart_price = 0;
            }
        }
    }

    public function mount()
    {
        $this->update_cart();
    }
    public function render()
    {

        return view('livewire.nav-control');
    }
}
