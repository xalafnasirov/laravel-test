<?php

namespace App\Livewire\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Cart extends Component
{

    protected $listeners = [
        "on_retrieve_cart" => "get_cart"
    ];

    public $cart;
    public $cart_price = 0;
    public $cart_product_count = 0;
    public $order_quantity;

    public function increase()
    {
        $this->order_quantity += 1;
    }

    public function decrease()
    {
        if ($this->order_quantity > 1) {
            $this->order_quantity -= 1;
        }
    }



    public function change_quantity($cart_id = null, $increase = null)
    {
        // $this->validateOnly('order_quantity');

        if ($cart_id === null || $increase === null) {
            return;
        }


        $id = null;
        $id_column = null;

        if (Auth::guard("web")->check()) {
            $id = Auth::guard("web")->id();
            $id_column = 'user_id';
        } else {
            if (Session::has('cart_token')) {
                $id = Session::get('cart_token');
                $id_column = 'guest_token';
            } else {
                return;
            }
        }

        $item = null;

        foreach ($this->cart as $single) {
            if (
                $single['id'] == $cart_id &&
                $single[$id_column] == $id &&
                $single['status'] == 'active'
            ) {
                $item = $single;
                break;
            }
        }

        if ($item === null) {
            return;
        }
       


        $item_quantity =  $item['quantity'];
        $item_price= $item['single_price'];
        $new_price = 0;

        
        // dd($item_price);


        if ($increase === 1) {
            $item_quantity += 1;
        } else if ($increase === 0) {
            if ($item_quantity > 1) {
                $item_quantity -= 1;
            } else {
                return;
            }
        }
        $new_price = $item_quantity * $item_price;

        DB::table("cart")
            ->where([
                $id_column => $id,
                'status' => 'active',
                'id' => $cart_id
            ])
            ->update([
                'quantity' => $item_quantity,
                'price' => $new_price
            ]);

        $this->dispatch('on_get_cart');
    }

    public function remove_cart_item($item_id)
    {
        $id = null;
        $id_column = null;
        if (Auth::guard("web")->check()) {
            $id = Auth::guard("web")->id();
            $id_column = 'user_id';
        } else {
            if (Session::has('cart_token')) {
                $id = Session::get('cart_token');
                $id_column = 'guest_token';
            } else {
                return;
            }
        }
        DB::table("cart")
            ->where([
                $id_column => $id,
                'status' => 'active',
                'id' => $item_id
            ])
            ->delete();

        $this->dispatch('on_get_cart');
    }

    function get_cart($cart, $cart_product_count, $cart_price)
    {
        $this->cart = $cart;
        $this->cart_product_count = $cart_product_count;
        $this->cart_price = $cart_price;
    }

    function get_image($product_id) {}

    public function mount()
    {
        $this->dispatch('on_get_cart');
    }
    public function render()
    {
        return view('livewire.services.cart');
    }
}
