<?php

namespace App\Livewire\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class TireShop extends Component
{
    public $filtered_product;
    public $filtered_product_count;
    public $product_image;
    public $page_limit = 20;
    public $page_count;
    public $current_page = 1;
    public $start_position = 0;
    public $search_key;
    public $search_brand;
    public $search_category;
    public $search_part_name;
    public $search_min_price;
    public $search_max_price;
    public $category;
    public $part_name;
    public $selected_category;
    public $selected_part_name;
    public $product;

    public function open_product($id = null) {
        if ($id === null) {
            return;
        }

        Validator::make(['id'], [
            'id'=>'required|integer',
        ]);

        if (!DB::table('product')->where('id', '=', $id)->exists())  {
            return;
        }

        return redirect()->route('services.shop_single', ['id'=>$id]);

    }

    public function add_to_cart($id = null)
    {
        if ($id === null) {
            return;
        }

        $validator = Validator::make(
            ['id' => $id], // The data you want to validate
            ['id' => 'required|integer'] // Validation rules
        );

        if ($validator->fails()) {
            return; // Validation failed, exit function or handle error
        }

        if (!DB::table('product')->find($id)) {
            return;
        }

        $this->product = DB::table('product')
            ->join("car_part_detail", "product.detail_id", "=", "car_part_detail.id")
            ->select([
                'product.*',
                'car_part_detail.price as price'
            ])
            ->where('product.id', $id)->first();

        $price = $this->product->price;

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
                        'quantity' => $existing_product->quantity + 1,
                        'price' => $existing_product->price + $price,
                    ]);
            } else {
                DB::table('cart')->insert([
                    'user_id' => $user_id,
                    'product_id' => $this->product->id,
                    'quantity' => 1,
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
                        'quantity' => $existing_product->quantity + 1,
                        'price' => $existing_product->price + $price,
                    ]);
            } else {
                DB::table('cart')->insert([
                    'guest_token' => Session::get('cart_token'),
                    'product_id' => $this->product->id,
                    'quantity' => 1,
                    'price' => $price,
                ]);
            }

            $this->dispatch('print', 'Product added to guest cart ');
        }

        $this->dispatch('on_update_cart',);

        return redirect()->route('services.checkout');
    }


    public function remove_search_tag($tag_name = null)
    {
        if ($tag_name === null || empty($tag_name)) {
            return;
        }
        $this->reset($tag_name);
        $this->get_product_count();
        $this->get_product();
    }

    public function get_all_part_name()
    {
        $this->part_name = DB::table("car_part_sub_category")
            ->when($this->selected_category, function ($query) {
                $query->where(function ($query) {
                    $query->where([
                        'category_id' => $this->selected_category
                    ]);
                });
            })
            ->get();
    }

    public function updatedSearchMinPrice()
    {
        if ($this->search_min_price === null || !is_numeric($this->search_min_price)) {
            return;
        }

        $this->get_product_count();
        $this->get_product();
    }

    public function updatedSearchMaxPrice()
    {
        if ($this->search_max_price === null || !is_numeric($this->search_max_price)) {
            return;
        }

        $this->get_product_count();
        $this->get_product();
    }


    public function updatedSelectedPartName()
    {
        if ($this->selected_part_name === null) {
            return;
        }

        if (empty($this->selected_part_name)) {
            $this->search_part_name = "";
            $this->get_product_count();
            $this->get_product();
            return;
        }

        $this->search_part_name = DB::table('car_part_sub_category')->find($this->selected_part_name)->name;

        $this->get_product_count();
        $this->get_product();
    }

    public function updatedSelectedCategory()
    {
        if ($this->selected_category === null) {
            return;
        }

        $this->get_all_part_name();

        if (empty($this->selected_category)) {
            $this->search_category = "";
            $this->get_product_count();
            $this->get_product();
            return;
        }

        $this->search_category = DB::table('car_part_category')->find($this->selected_category)->name;

        $this->get_product_count();
        $this->get_product();
    }

    public function updatedSearchKey()
    {
        $this->get_product_count();
        $this->get_product();
    }

    public function get_all_category()
    {
        $this->category = DB::table("car_part_category")->get();
    }

    public function on_search_brand($brand_name = null)
    {
        if ($brand_name === null) {
            return;
        }

        $this->search_brand = $brand_name;

        $this->get_product_count();
        $this->get_product();
    }

    public function on_search_category($name = null)
    {
        if ($name === null) {
            return;
        }

        $this->search_category = $name;

        $this->get_product_count();
        $this->get_product();
    }

    public function on_search_part($name = null)
    {
        if ($name === null) {
            return;
        }

        $this->search_part_name = $name;

        $this->get_product_count();
        $this->get_product();
    }


    public function get_offset(): int
    {
        if ($this->current_page > 0) {
            return ($this->current_page - 1) * $this->page_limit;
        } else {
            return 0;
        }
    }

    public function on_page_limit_change()
    {
        $this->current_page = 1;
    }

    public function prev_page()
    {
        if ($this->current_page <= 1) {
            return;
        }
        $this->current_page -= 1;
    }

    public function next_page()
    {
        if ($this->current_page >= $this->page_count) {
            return;
        }
        $this->current_page += 1;
    }

    public function set_page($page)
    {
        $this->current_page = $page;
    }

    public function get_pagination()
    {
        if ($this->filtered_product_count != 0) {
            $this->page_count = ceil($this->all_user_count / $this->page_limit);
        }
    }

    public function get_product()
    {
        $this->filtered_product = DB::table('product')
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
                'product.active' => 1,
                'product.product_type_id' => '2',
            ])
            // ->when($this->search_brand, function ($query) {
            //     $query->where(function ($query) {
            //         $query->where([
            //             'car_brand.name' => $this->search_brand,
            //         ]);
            //     });
            // })
            // ->when($this->search_category, function ($query) {
            //     $query->where(function ($query) {
            //         $query->where([
            //             'car_part_category.name' => $this->search_category
            //         ]);
            //     });
            // })
            // ->when($this->search_part_name, function ($query) {
            //     $query->where(function ($query) {
            //         $query->where([
            //             'car_part_sub_category.name' => $this->search_part_name
            //         ]);
            //     });
            // })
            // ->when(!empty($this->search_key), function ($query) {
            //     $query->where(function ($query) {
            //         $query->where('car_brand.name', 'LIKE', '%' . $this->search_key . '%')
            //             ->orWhere('car_part_category.name', 'LIKE', '%' . $this->search_key . '%')
            //             ->orWhere('car_part_sub_category.name', 'LIKE', '%' . $this->search_key . '%');
            //     });
            // })
            // ->when(!empty($this->search_min_price), function ($query) {
            //     $query->where('car_part_detail.price', '>=', $this->search_min_price);
            // })
            // ->when(!empty($this->search_max_price), function ($query) {
            //     $query->where('car_part_detail.price', '<=', $this->search_max_price);
            // })
            ->get();

            // dd($this->filtered_product);

        $this->filtered_product_count = count($this->filtered_product);


        if ($this->filtered_product) {
            foreach ($this->filtered_product as $product) {
                $this->product_image[$product->id] =  DB::table('product_image')->where('product_id', $product->id)->select('image')->first();
            }
        }


        $this->dispatch('print', $this->filtered_product);
    }

    public function get_product_count()
    {
        $this->filtered_product_count = DB::table("product")
            ->where('active', '=', 1)
            ->count();
    }

    public function print($req = null)
    {
        if ($req === null) {
            $this->dispatch('print', 'works');
        } else {
            $this->dispatch('print', $req);
        }
    }

    public function mount()
    {

        $this->get_product_count();
        $this->get_product();
        $this->get_all_category();
        $this->get_all_part_name();
    }

    public function render()
    {
        return view('livewire.services.tire-shop');
    }
}
