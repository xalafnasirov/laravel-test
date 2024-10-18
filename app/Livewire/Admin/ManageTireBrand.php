<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ManageTireBrand extends Component
{
    use WithFileUploads;

    public $title;
    public $image;
    public $all_brand;
    public $all_brand_count;
    public $edit_item;
    public $edit_title;
    public $edit_country;
    public $temp_edit_brand_image;
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
                $this->temp_image[0] = $photo;
            }
        }
    }

    public $product_image;
    public $edit_temp_image = [];
    public $edit_image;

    public function remove_product_photo($index)
    {
        if ($index === null) {
            return;
        }

        if (isset($this->product_image)) {


            foreach ($this->product_image as $key => $single) {

                if ($single->image === null) {
                    return;
                }

                if (Storage::disk('public')->exists($single->image)) {
                    Storage::disk('public')->delete($single->image);
                }

                DB::table('tire_brand')
                    ->where([
                        'id' => $single->id
                    ])
                    ->update([
                        'image' => null
                    ]);

                unset($this->product_image[$key]);
            }
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

        $this->remove_product_photo($this->edit_item->id);

        if (is_array($this->edit_image)) {
            foreach ($this->edit_image as $image) {
                $this->edit_temp_image[0] = $image;
            }
        }
    }

    public function cancel()
    {
        $this->reset(['title', 'image']);
    }

    public function delete($brand_id = null)
    {
        if ($brand_id == null) {
            $this->dispatch('alert_warning', 'Zəhmət olmasa, səhifəni yeniləyin!');
            return;
        }

        DB::table('tire_brand')->delete($brand_id);

        $this->dispatch('alert_warning', 'Marka silindi!');
    }

    function open_modal()
    {
        $this->dispatch('open_edit_brand');
    }

    public function edit($id = null)
    {

        if ($id == null) {
            $this->dispatch('alert_warning', 'Zəhmət olmasa, səhifəni yeniləyin!');
            return;
        }
        $this->edit_item = DB::table('tire_brand')->find($id);
        $this->edit_title = $this->edit_item->name;
        $this->edit_country = $this->edit_item->country_id;

        $this->product_image = DB::table('tire_brand')->where('id', $id)->get();

        if ($this->edit_item) {
            $this->open_modal();
        } else {
            return;
        }
    }

    public function edit_reset()
    {
        // $this->reset(['edit_title', 'edit_image', 'edit_temp_image']);
    }

    public function edit_submit($id = null)
    {
        if ($id == null) {
            $this->dispatch('alert_warning', 'Zəhmət olmasa, səhifəni yeniləyin!');
            return;
        }

        if (!$this->edit_title) {
            $this->dispatch('alert_warning', 'Adı boş qoya bilməzsiniz!');
            return;
        }

        if (!$this->edit_country) {
            $this->dispatch('alert_warning', 'Ölkə seçin!');
            return;
        }

        DB::table('tire_brand')->where('id', $id)->update([
            'name' => $this->edit_title,
            'country_id' => $this->edit_country
        ]);


        foreach ($this->edit_temp_image as $image) {
            $random_id = Str::random(10);

            $date_now = Carbon::now()->format('d_m_Y');

            $filename = $date_now . '_' . $random_id . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs("/images/tire_brand", $filename, 'public');

            DB::table('tire_brand')->where('id', $id)->update(['image' => $path]);
        }

        $this->dispatch('alert_success', 'Marka dəyişdirildi!');

        $this->reset(['edit_title', 'edit_image', 'edit_temp_image']);
    }


    public function submit()
    {
        try {
            $this->validate([
                'title' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            $this->dispatch('alert_warning', "Marka adını yazın");
            return;
        }

        if (!$this->selected_country) {
            $this->dispatch('alert_warning', 'Ölkə seçin');
        }

        if (!$this->temp_image) {
            $this->dispatch('alert_warning', 'Şəkil seçin');
            return;
        }

        // Image
        foreach ($this->temp_image as $image) {
            $random_id = Str::random(10);

            $date_now = Carbon::now()->format('d_m_Y');

            $filename = $date_now . '_' . $random_id . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs("/images/tire_brand", $filename, 'public');

            DB::table('tire_brand')->insert(
                [
                    'name' => $this->title,
                    'country_id' => $this->selected_country,
                    'image' => $path
                ]
            );
        }

        $this->dispatch('alert_success', 'Yeni marka əlavə olundu!');

        $this->reset(['title', 'image']);

        $this->get_brand();
    }

    public function get_brand()
    {
        $this->all_brand = DB::table('tire_brand')->get();
        $this->all_brand_count = DB::table('tire_brand')->count();
    }

    // Get country
    public $all_country;
    public $selected_country;
    public function get_country()
    {
        $this->all_country = DB::table('tire_country')->get();
    }

    public function mount()
    {
        $this->get_brand();
        $this->get_country();
    }

    public function render()
    {
        return view('admin.livewire.manage-tire-brand');
    }
}
