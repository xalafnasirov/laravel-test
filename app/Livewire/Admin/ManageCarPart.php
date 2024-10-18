<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ManageCarPart extends Component
{
    use WithFileUploads;

    public $search_key;
    public $price;
    public $condition = 1;
    public $all_brand;
    public $all_category;
    public $all_sub_category;
    public $all_car_part;
    public $all_car_part_count;
    public $selected_brand;
    public $selected_category;
    public $selected_sub_category;
    public $edit_item;
    public $edit_brand;
    public $edit_title;
    public $edit_condition;
    public $edit_price;
    public $temp_image = [];
    public $photo = [];

    public function remove_temp_photo($index)
    {
        if ($index === null) {
            return;
        }

        if (isset($this->temp_image[$index])) {
            unset($this->temp_image[$index]);
        } else {
            return;
        }

        $this->dispatch('alert_warning', 'Seçdiyiniz şəkil silindi!');
    }
    public function updatedPhoto()
    {
        $this->validate([
            'photo.*' => 'image|mimes:jpeg,png,jpg|max:20048',
        ]);

        if (is_array($this->photo)) {
            foreach ($this->photo as $photo) {
                $this->temp_image[] = $photo;
            }
        }
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return;
        }

        $product = DB::table('product')->find($id);

        $image_to_delete = DB::table('product_image')
            ->where([
                'product_id' => $product->id,
            ])->get();

        if ($image_to_delete) {
            foreach ($image_to_delete as $single) {

                if (Storage::disk('public')->exists($single->image)) {
                    Storage::disk('public')->delete($single->image);
                }
            }
        }

        DB::table('product')->delete($product->id);

        DB::table('car_part_detail')->delete($product->detail_id);

        DB::table('product_image')
            ->where([
                'product_id' => $id
            ])->delete();

        $this->get_car_part();

        $this->dispatch('alert_warning', 'Maşın hissəsi silindi!');
    }

    function open_modal()
    {
        $this->dispatch('open_edit_car_part');
    }

    public function on_edit_condition($id = null, $condition = null)
    {
        if ($id === null || $condition === null) {
            return;
        }

        if ($condition == 1) {
            $condition = 0;
            DB::table('product')->where('id', $id)->update(['active' => $condition]);
            $this->dispatch('alert_warning', 'Hissə dektivləşdi');
        } else if ($condition == 0) {
            $condition = 1;
            DB::table('product')->where('id', $id)->update(['active' => $condition]);
            $this->dispatch('alert_success', 'Hissə aktivləşdi');
        }

        $this->get_car_part();
    }

    public function edit($id = null)
    {
        if ($id === null) {
            return;
        }

        $this->edit_item = DB::table('product')
            ->join('car_part_detail', 'product.detail_id', '=', 'car_part_detail.id')
            ->select([
                'product.*',
                'car_part_detail.brand_id',
                'car_part_detail.category_id',
                'car_part_detail.sub_category_id',
                'car_part_detail.price as price'
            ])
            ->where('product.id', $id)
            ->first();

        if (!$this->edit_item) {
            return;
        }


        $this->edit_brand = $this->edit_item->brand_id;
        $this->edit_price = $this->edit_item->price;

        $this->product_image = DB::table('product_image')
            ->where('product_id', $id)->get();

        $this->open_modal();

        // $this->edit_image = DB::table('image')->where('category_id', '=', $id)
        // ->select('image')->first();

        // if ($this->edit_item) {
        //     $this->open_modal();
        // } else {
        //     $this->dispatch('alert_warning', 'Zəhmət olmasa, səhifəni yeniləyin!');
        // }
    }

    public function edit_reset()
    {
        $this->reset(['edit_title', 'edit_image']);
    }

    // Edit image 
    public $product_image;
    public $edit_temp_image = [];
    public $edit_image;

    public function remove_product_photo($index)
    {
        if ($index === null) {
            return;
        }

        if (isset($this->product_image[$index])) {

            if (Storage::disk('public')->exists($this->product_image[$index]->image)) {
                Storage::disk('public')->delete($this->product_image[$index]->image);
            }

            DB::table('product_image')
                ->where([
                    'product_id' => $this->edit_item->id,
                    'image' => $this->product_image[$index]->image

                ])->delete();

            unset($this->product_image[$index]);
        } else {
            return;
        }
    }

    public function remove_edit_temp_photo($index)
    {
        if ($index === null) {
            return;
        }

        if (isset($this->edit_temp_image[$index])) {
            unset($this->edit_temp_image[$index]);
        } else {
            return;
        }
    }

    public function updatedEditImage()
    {
        $this->validate([
            'edit_image.*' => 'image|mimes:jpeg,png,jpg|max:20048',
        ]);

        if (is_array($this->edit_image)) {
            foreach ($this->edit_image as $image) {
                $this->edit_temp_image[] = $image;
            }
        }
    }

    public function edit_submit($id = null)
    {

        if ($id === null) {
            return;
        }

        if (!$this->edit_brand) {
            return;
        }

        if (!$this->edit_price) {
            return;
        }

        if (!$this->product_image) {
            return;
        }

        $check_product_exist = DB::table("car_part_detail")->where([
            "brand_id" => $this->edit_brand,
            "category_id" => $this->edit_item->category_id,
            "sub_category_id" => $this->edit_item->sub_category_id
        ])->first();

        if ($check_product_exist) {
            if ($check_product_exist->id !== $this->edit_item->detail_id) {
                $existing_product = DB::table("product")->where([
                    'product_type_id' => $check_product_exist->product_type_id,
                    'detail_id' => $check_product_exist->id,
                ])->first();
                $this->dispatch('alert_warning', "Bu hissə artıq mövcuddur: {$existing_product->id}");
                return;
            }
        }

        $product = DB::table('product')->find($id);

        DB::table('car_part_detail')
            ->where('id', $product->detail_id)
            ->update([
                'brand_id' => $this->edit_brand,
                'price' => $this->edit_price,
            ]);

        foreach ($this->edit_temp_image as $image) {
            $random_id = Str::random(10);

            $date_now = Carbon::now()->format('d_m_Y');

            $filename = $date_now . '_' . $random_id . '.' . $image->getClientOriginalExtension();

            // dd($filename);

            $path = $image->storeAs("/images/car-part/{$this->selected_category}", $filename, 'public');

            DB::table('product_image')->insert(
                ['product_id' => $id, 'image' => $path]
            );
        }

        $this->dispatch('alert_success', 'Maşın hissəsi dəyişdirildi!');

        $this->reset(['edit_brand', 'product_image', 'edit_image', 'edit_temp_image', 'edit_price']);

        $this->get_car_part();
    }

    public function cancel()
    {
        $this->reset(['image']);
    }
    public function submit()
    {
        if (!$this->selected_brand) {
            $this->dispatch('alert_warning', "Marka seçin");
            return;
        }

        if (!$this->selected_category) {
            $this->dispatch('alert_warning', "Kateqoriya seçin");
            return;
        }

        if (!$this->selected_sub_category) {
            $this->dispatch('alert_warning', "Hissə adı seçin");
            return;
        }

        $check_product_exist = DB::table("car_part_detail")->where([
            "brand_id" => $this->selected_brand,
            "category_id" => $this->selected_category,
            "sub_category_id" => $this->selected_sub_category
        ])->first();

        if ($check_product_exist) {
            $existing_product = DB::table("product")->where([
                'product_type_id' => $check_product_exist->product_type_id,
                'detail_id' => $check_product_exist->id,
            ])->first();
            $this->dispatch('alert_warning', "Bu hissə artıq mövcuddur: {$existing_product->id}");
            return;
        }

        if (!$this->price) {
            $this->dispatch('alert_warning', "Hissə üçün qiymət seçin");
            return;
        }

        if ($this->condition != 1) {
            $this->condition = 0;
        }

        if (!$this->temp_image) {
            $this->dispatch('alert_warning', 'Şəkil seçin');
            return;
        }

        // Details
        $detail_id = DB::table('car_part_detail')->insertGetId(
            [
                'brand_id' => $this->selected_brand,
                'product_type_id' => 1,
                'category_id' => $this->selected_category,
                'sub_category_id' => $this->selected_sub_category,
                'price' => $this->price,
            ]
        );

        // Product management
        $product_id = DB::table('product')->insertGetId([
            'product_type_id' => 1,
            'detail_id' => $detail_id,
            'active' => $this->condition
        ]);

        // Image
        foreach ($this->temp_image as $image) {
            $random_id = Str::random(10);

            $date_now = Carbon::now()->format('d_m_Y');

            $filename = $date_now . '_' . $random_id . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs("/images/car-part/{$this->selected_category}", $filename, 'public');

            DB::table('product_image')->insert(
                ['product_id' => $product_id, 'image' => $path]
            );
        }

        $this->dispatch('alert_success', 'Yeni alt kateqoriya əlavə olundu!');

        $this->get_car_part();

        // $this->reset(['temp_image', 'photo']);
    }

    public function get_brand()
    {
        $this->all_brand = DB::table('car_brand')->get();
    }
    public function get_category()
    {
        $this->all_category = DB::table('car_part_category')->get();
    }

    public function get_sub_category()
    {
        $this->all_sub_category = DB::table('car_part_sub_category')
            ->where('category_id', $this->selected_category)
            ->get();
    }

    public function get_car_part()
    {
        $this->all_car_part = DB::table('product')
            ->join("car_part_detail", "product.detail_id", "=", "car_part_detail.id")
            ->join("car_brand", "car_part_detail.brand_id", "=", "car_brand.id")
            ->join("car_part_category", "car_part_detail.category_id", "=", "car_part_category.id")
            ->join("car_part_sub_category", "car_part_detail.sub_category_id", "=", "car_part_sub_category.id")
            ->select([
                'product.*',
                'car_brand.name as brand',
                'car_part_category.name as category',
                'car_part_sub_category.name as sub_category',
                'car_part_detail.price as price',
                'product.active as condition'
            ])
            ->when(!empty($this->search_key), function ($query) {
                $query->where(function ($query) {
                    $query->where('car_brand.name', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('car_part_category.name', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('product.id', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('car_part_sub_category.name', 'LIKE', '%' . $this->search_key . '%');
                });
            })
            ->where([
                'product.product_type_id' => 1
            ])->get();

        $this->all_car_part_count = count($this->all_car_part);
    }

    public function updatedSearchKey() {
       $this->get_car_part();
    }
    function print($msg)
    {
        $this->dispatch('print', ['message' => $msg]);
    }

    public function mount()
    {
        $this->get_car_part();
        $this->get_brand();
        $this->get_category();
    }

    public function render()
    {
        return view('admin.livewire.manage-car-part');
    }
}
