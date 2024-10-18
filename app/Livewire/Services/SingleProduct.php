<?php

namespace App\Livewire\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Livewire\Client\NavControl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SingleProduct extends Component
{
    public $id;
    public $product;
    public $product_image;
    public $order_quantity = 1;
    public $product_type;

    public function mount($id)
    {
        $this->id = $id;
        $this->get_product();
    }

    public function get_product()
    {
        if ($this->id === null || empty($this->id)) {
            return redirect()->route('services.shop');
        }

        $validator = Validator::make(['id' => $this->id], [
            'id' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->route('services.shop');
        }



        if (DB::table("product")->where('id', $this->id)->exists()) {

            $this->product_type = DB::table("product")->where('id', $this->id)->first()->product_type_id;

            switch ($this->product_type) {
                case 1:
                    # car part...   
                    $this->product = DB::table("product")
                        ->join("car_part_detail", "product.detail_id", "=", "car_part_detail.id")
                        ->join("car_brand", "car_part_detail.brand_id", "=", "car_brand.id")
                        ->join("car_part_category", "car_part_detail.category_id", "=", "car_part_category.id")
                        ->join("car_part_sub_category", "car_part_detail.sub_category_id", "=", "car_part_sub_category.id")
                        ->join('product_type', 'product.product_type_id', '=', 'product_type.id')
                        ->select([
                            'product.*',
                            'car_brand.name as brand',
                            'car_part_detail.category_id',
                            'car_part_detail.brand_id',
                            'car_part_category.name as category',
                            'car_part_sub_category.name as part_name',
                            'car_part_detail.price as price',
                            'product_type.name as product_type'
                        ])
                        ->where([
                            ["product.id", '=', $this->id],
                            ["product.active", '=', 1],
                        ])
                        ->first();

                    break;

                case 2:
                    # tire...   
                    $this->product = DB::table('product')
                        ->join('tire_detail', 'tire_detail.product_id', '=', 'product.id')
                        ->join('tire_brand', 'tire_detail.brand_id', '=', 'tire_brand.id')
                        ->join('tire_country', 'tire_brand.country_id', '=', 'tire_country.id')
                        ->join('tire_season', 'tire_detail.season_id', '=', 'tire_season.id')
                        ->select([
                            'product.*',
                            'product.active as condition',
                            'tire_detail.model as model',
                            'tire_detail.type as type',
                            'tire_detail.year as year',
                            'tire_detail.warranty_mileage as warranty_mileage',
                            'tire_detail.speed_index as speed_index',
                            'tire_detail.load_index as load_index',
                            'tire_detail.price as price',
                            'tire_brand.name as brand',
                            'tire_country.name as country',
                            'tire_season.name as season',
                        ])
                        ->where([
                            'product.id' => $this->id,
                        ])->first();
                    break;

                case 3:
                    # inspection...   
                    break;

                default:
                    # code...
                    break;
            }






            $this->product_image = DB::table('product_image')
                ->where('product_id', $this->id)
                ->get();

            $this->get_related_products($this->product_type);

        } else {
            return redirect()->route('services.shop');
        }
    }

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

    public function add_to_cart()
    {

        if ($this->order_quantity < 1 && !is_numeric($this->order_quantity)) {
            return;
        }


        $price = $this->order_quantity * $this->product->price;

        if (Auth::guard('web')->check()) {

            $user_id = Auth::guard('web')->id();

            $existing_product = DB::table('cart')
                ->where([
                    'user_id' => $user_id,
                    'product_id' => $this->product->id,
                    'status' => 'active'
                ])
                ->first();

            if ($existing_product) {
                DB::table('cart')
                    ->where([
                        'user_id' => $user_id,
                        'product_id' => $this->product->id,
                        'status' => 'active'
                    ])
                    ->update([
                        'quantity' => $existing_product->quantity + $this->order_quantity,
                        'price' => $existing_product->price + $price,
                    ]);
            } else {
                DB::table('cart')->insert([
                    'user_id' => $user_id,
                    'product_id' => $this->product->id,
                    'quantity' => $this->order_quantity,
                    'price' => $price,
                ]);
            }

            $this->dispatch('print', 'Product added to loginned user cart ');
        } else {

            if (!Session::has("cart_token")) {
                $cart_token = Str::random(60);
                Session::put("cart_token", $cart_token);
            }

            $existing_product = DB::table('cart')
                ->where([
                    'guest_token' => Session::get('cart_token'),
                    'product_id' => $this->product->id,
                    'status' => 'active'
                ])
                ->first();

            if ($existing_product) {
                DB::table('cart')
                    ->where([
                        'guest_token' => Session::get('cart_token'),
                        'product_id' => $this->product->id,
                        'status' => 'active'
                    ])
                    ->update([
                        'quantity' => $existing_product->quantity + $this->order_quantity,
                        'price' => $existing_product->price + $price,
                    ]);
            } else {
                DB::table('cart')->insert([
                    'guest_token' => Session::get('cart_token'),
                    'product_id' => $this->product->id,
                    'quantity' => $this->order_quantity,
                    'price' => $price,
                ]);
            }
        }

        $this->dispatch('on_update_cart',);

        return redirect()->route('services.checkout');
    }
    // Related products
    public $related_products;
    public $related_product_image;
    public function get_related_products($type)
    {
        switch ($type) {
            case 1:
                # car part... 
                $this->related_products = DB::table("product")
                    ->join("car_part_detail", "product.detail_id", "=", "car_part_detail.id")
                    ->join("car_brand", "car_part_detail.brand_id", "=", "car_brand.id")
                    ->join("car_part_category", "car_part_detail.category_id", "=", "car_part_category.id")
                    ->join("car_part_sub_category", "car_part_detail.sub_category_id", "=", "car_part_sub_category.id")
                    ->select([
                        'product.*',
                        'car_brand.name as brand',
                        'car_part_detail.category_id',
                        'car_part_detail.brand_id',
                        'car_part_category.name as category',
                        'car_part_sub_category.name as part_name',
                        'car_part_detail.price as price'
                    ])
                    ->where([
                        'product.active' => 1,
                    ])
                    ->where(function ($query) {
                        $query->where('car_part_detail.category_id', $this->product->category_id)
                            ->orWhere('car_part_detail.brand_id', $this->product->brand_id);
                    })
                    ->get();
                break;

            case 2:
                # tire...   
                break;

            case 3:
                # inspection...   
                break;

            default:
                # code...
                break;
        }


        if ($this->related_products) {
            foreach ($this->related_products as $product) {
                $this->related_product_image[$product->id] =  DB::table('product_image')->where('product_id', $product->id)->select('image')->first();
            }
        }
    }

    public function render()
    {
        return view('livewire.services.single_product');
    }
}
