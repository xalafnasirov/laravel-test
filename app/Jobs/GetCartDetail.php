<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class GetCartDetail implements ShouldQueue
{
    use Queueable;
    private $data;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $cart = null;
        $id = null;
        $id_column = '';
        $cart_product_count = 0;
        $cart_price = 0;

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

        $cart_product_count = DB::table('cart')
            ->where([
                $id_column => $id,
                'status' => 'active'
            ])
            ->count();
        $cart_price = DB::table('cart')
            ->where([
                $id_column => $id,
                'status' => 'active'
            ])
            ->sum('price');


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

            Cache::put('cart_details', [
                'cart' => $cart,
                'cart_price' => $cart_price,
                'cart_product_count' => $cart_product_count
            ], 600); 

        // $this->data = $cart;
        
        // $this->dispatch('on_retrieve_cart', $cart, $cart_product_count, $cart_price);
    }

    public function get_response() {
        return $this->data;
    }
}
