<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ManageTire extends Component
{
    use WithFileUploads;

    public $search_key;
    public $price;
    public $condition = 1;
    public $all_brand;
    public $all_season;
    public $model;
    public $type;
    public $year;
    public $warranty_mileage;
    public $speed_index;
    public $load_index;
    public $all_tire;
    public $all_tire_count;
    public $selected_brand;
    public $selected_season;


    // Image upload
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

    // Remove item
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

        $this->get_all_tire();

        $this->dispatch('alert_warning', 'Maşın hissəsi silindi!');
    }

    // Edit modal page
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

        $this->get_all_tire();
    }

    // Edit image 
    public $edit_product_image;
    public $edit_image;
    public $edit_temp_image = [];
    public $edit_item;
    public $edit_brand;
    public $edit_condition;
    public $edit_price;
    public $edit_season;
    public $edit_model;
    public $edit_type;
    public $edit_year;
    public $edit_warranty_mileage;
    public $edit_speed_index;
    public $edit_load_index;

    public function edit($id = null)
    {
        if ($id === null) {
            return;
        }

        $this->edit_item = DB::table('product')
            ->join('tire_detail', 'tire_detail.product_id', '=', 'product.id')
            ->join('tire_brand', 'tire_detail.brand_id', '=', 'tire_brand.id')
            ->join('tire_country', 'tire_brand.country_id', '=', 'tire_country.id')
            ->join('tire_season', 'tire_detail.season_id', '=', 'tire_season.id')
            ->select([
                'product.id as id',
                'tire_detail.model as model',
                'tire_detail.type as type',
                'tire_detail.year as year',
                'tire_detail.warranty_mileage as warranty_mileage',
                'tire_detail.speed_index as speed_index',
                'tire_detail.load_index as load_index',
                'tire_detail.price as price',
                'tire_brand.id as brand_id',
                'tire_season.id as season_id',
            ])
            ->where([
                'product.product_type_id' => '2',
                'product.id' => $id,
            ])->first();

        if (!$this->edit_item) {
            return;
        }

        $this->edit_brand = $this->edit_item->brand_id;
        $this->edit_season = $this->edit_item->season_id;
        $this->edit_model = $this->edit_item->model;
        $this->edit_type = $this->edit_item->type;
        $this->edit_year = $this->edit_item->year;
        $this->edit_warranty_mileage = $this->edit_item->warranty_mileage;
        $this->edit_speed_index = $this->edit_item->speed_index;
        $this->edit_load_index = $this->edit_item->load_index;
        $this->edit_price = $this->edit_item->price;

        $this->edit_product_image = DB::table('product_image')
            ->where('product_id', $id)->get();

        $this->open_modal();
    }
    public function edit_reset()
    {
        // $this->reset(['edit_title', 'edit_image']);
    }
    public function remove_product_photo($index)
    {
        if ($index === null) {
            return;
        }

        if (isset($this->edit_product_image[$index])) {

            if (Storage::disk('public')->exists($this->edit_product_image[$index]->image)) {
                Storage::disk('public')->delete($this->edit_product_image[$index]->image);
            }

            DB::table('product_image')
                ->where([
                    'product_id' => $this->edit_item->id,
                    'image' => $this->edit_product_image[$index]->image

                ])->delete();

            unset($this->edit_product_image[$index]);
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
        if (!$this->edit_season) {
            return;
        }
        if (!$this->edit_model) {
            return;
        }
        if (!$this->edit_type) {
            return;
        }
        if (!$this->edit_warranty_mileage) {
            return;
        }
        if (!$this->edit_speed_index) {
            return;
        }
        if (!$this->edit_load_index) {
            return;
        }
        if (!$this->edit_price) {
            return;
        }

        // $check_product_exist = DB::table("tire_detail")
        // ->where([
        //     "brand_id" => $this->edit_brand,
        //     "season_id" => $this->edit_season,
        //     "model" => $this->edit_model,
        //     "type" => $this->edit_type,
        //     "year" => $this->edit_year,
        //     "warranty_mileage" => $this->edit_warranty_mileage,
        //     "speed_index" => $this->edit_speed_index,
        //     "load_index" => $this->edit_load_index,
        //     "price" => $this->edit_price,
        // ])->first();

        // if ($check_product_exist) {
        //     $this->dispatch('alert_warning', "Bu hissə artıq mövcuddur: {$check_product_exist->product_id}");
        //     return;
        // }

        DB::table('tire_detail')
            ->where('product_id', $id)
            ->update([
                "brand_id" => $this->edit_brand,
                "season_id" => $this->edit_season,
                "model" => $this->edit_model,
                "type" => $this->edit_type,
                "year" => $this->edit_year,
                "warranty_mileage" => $this->edit_warranty_mileage,
                "speed_index" => $this->edit_speed_index,
                "load_index" => $this->edit_load_index,
                "price" => $this->edit_price,
            ]);

        foreach ($this->edit_temp_image as $image) {
            $random_id = Str::random(10);

            $date_now = Carbon::now()->format('d_m_Y');

            $filename = $date_now . '_' . $random_id . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs("/images/tire/{$this->edit_brand}", $filename, 'public');

            DB::table('product_image')->insert(
                ['product_id' => $id, 'image' => $path]
            );
        }

        $this->dispatch('alert_success', 'Maşın hissəsi dəyişdirildi!');

        // $this->reset(['edit_brand', 'product_image', 'edit_image', 'edit_temp_image', 'edit_price']);

        $this->get_all_tire();
    }

    public function submit()
    {
        if (!$this->selected_brand) {
            $this->dispatch('alert_warning', "Marka seçin");
            return;
        }

        if (!$this->selected_season) {
            $this->dispatch('alert_warning', "Hissə adı seçin");
            return;
        }

        if (!$this->model) {
            $this->dispatch('alert_warning', "Model yazın");
            return;
        }

        if (!$this->type) {
            $this->dispatch('alert_warning', "Tipin yazın");
            return;
        }

        if (!$this->year) {
            $this->dispatch('alert_warning', "İlin yazın");
            return;
        }

        if (!$this->warranty_mileage) {
            $this->dispatch('alert_warning', "Zəmanətin yazın");
            return;
        }

        if (!$this->speed_index) {
            $this->dispatch('alert_warning', "Sürət indeksin yazın");
            return;
        }

        if (!$this->load_index) {
            $this->dispatch('alert_warning', "Yükləmə indeksin yazın");
            return;
        }

        $check_product_exist = DB::table("tire_detail")->where([
            "brand_id" => $this->selected_brand,
            "season_id" => $this->selected_season,
            "model" => $this->model,
            "type" => $this->type,
            "year" => $this->year,
            "warranty_mileage" => $this->warranty_mileage,
            "speed_index" => $this->speed_index,
            "load_index" => $this->load_index,
        ])->first();

        if ($check_product_exist) {
            $this->dispatch('alert_warning', "Bu hissə artıq mövcuddur: {$check_product_exist->product_id}");
            return;
        }

        if (!$this->price) {
            $this->dispatch('alert_warning', "Təkər üçün qiymət seçin");
            return;
        }

        if ($this->condition != 1) {
            $this->condition = 0;
        }

        if (!$this->temp_image) {
            $this->dispatch('alert_warning', 'Şəkil seçin');
            return;
        }

        $product_id = DB::table('product')->insertGetId([
            'product_type_id' => 2,
            'active' => $this->condition
        ]);

        DB::table('tire_detail')->insertGetId(
            [
                "product_id" => $product_id,
                "brand_id" => $this->selected_brand,
                "season_id" => $this->selected_season,
                "model" => $this->model,
                "type" => $this->type,
                "year" => $this->year,
                "warranty_mileage" => $this->warranty_mileage,
                "speed_index" => $this->speed_index,
                "load_index" => $this->load_index,
                'price' => $this->price,
            ]
        );


        // Image
        foreach ($this->temp_image as $image) {
            $random_id = Str::random(10);

            $date_now = Carbon::now()->format('d_m_Y');

            $filename = $date_now . '_' . $random_id . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs("/images/tire/{$this->selected_brand}", $filename, 'public');

            DB::table('product_image')->insert(
                ['product_id' => $product_id, 'image' => $path]
            );
        }

        $this->dispatch('alert_success', 'Yeni təkər əlavə olundu!');

        $this->get_all_tire();
    }

    public function get_brand()
    {
        $this->all_brand = DB::table('tire_brand')->get();
    }

    public function get_season()
    {
        $this->all_season = DB::table('tire_season')->get();
    }

    public function get_all_tire()
    {
        $this->all_tire = DB::table('product')
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
            ->when(!empty($this->search_key), function ($query) {
                $query->where(function ($query) {
                    $query->where('tire_detail.model', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_detail.type', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_detail.year', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_detail.warranty_mileage', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_detail.speed_index', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_detail.load_index', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_brand.name', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_country.name as country', 'LIKE', '%' . $this->search_key . '%')
                        ->orWhere('tire_season.name', 'LIKE', '%' . $this->search_key . '%');
                });
            })
            ->where([
                'product.product_type_id' => '2',
            ])->get();

        $this->all_tire_count = count($this->all_tire);
    }

    public function updatedSearchKey()
    {
        $this->get_all_tire();
    }
    function print($msg)
    {
        $this->dispatch('print', ['message' => $msg]);
    }

    public function cancel()
    {
        $this->reset(['image']);
    }

    public function mount()
    {
        $this->get_brand();
        $this->get_season();
        $this->get_all_tire();
    }

    public function render()
    {
        return view('admin.livewire.manage-tire');
    }
}
