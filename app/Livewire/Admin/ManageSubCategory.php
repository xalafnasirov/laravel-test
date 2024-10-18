<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Exception;
use Illuminate\Support\Facades\DB;

class ManageSubCategory extends Component
{
    use WithFileUploads;

    public $title;
    public $image;
    public $all_category;
    public $all_sub_category;
    public $all_sub_category_count;
    public $selected_category;
    public $edit_item;
    public $edit_title;
    public $edit_image;
    public $temp_edit_image;

    public function on_temp_edit_image() {
        //$this->reset(['edit_category_image']);
    }

    public function delete($id = null) {

        if ($id == null) {
            $this->dispatch('alert_warning' , 'Zəhmət olmasa, səhifəni yeniləyin!');
            return;
        }

        DB::table('car_part_sub_category')->delete($id);

        $this->dispatch('alert_warning' , 'Alt Kateqoriya silindi!');
    }

    function open_modal() {
        $this->dispatch('open_edit_sub_category');
    }

    public function edit($id = null) {

        if ($id == null) {
            $this->dispatch('alert_warning' , 'Zəhmət olmasa, səhifəni yeniləyin!');
            return;
        }
        $this->edit_item = DB::table('car_part_sub_category')->find($id);
        $this->edit_title = $this->edit_item->name;

        // $this->edit_image = DB::table('image')->where('category_id', '=', $id)
        // ->select('image')->first();

        if ($this->edit_item) {
            $this->open_modal();
        } else {
            $this->dispatch('alert_warning' , 'Zəhmət olmasa, səhifəni yeniləyin!');
        }
    } 

    public function edit_reset() {
        $this->reset(['edit_title', 'edit_image']);
    }

    public function edit_submit($id = null) {
        if ($id == null) {
            $this->dispatch('alert_warning' , 'Zəhmət olmasa, səhifəni yeniləyin!');
            return;
        }

        if (!$this->edit_title) {
            $this->dispatch('alert_warning' , 'Adı boş qoya bilməzsiniz!');
            return;
        }

        DB::table('car_part_sub_category')->where('id', $id)->update(['name'=>$this->edit_title]);

        $this->dispatch('alert_success' , 'Alt kateqoriya dəyişdirildi!');

        $this->reset(['edit_title', 'edit_image']);
    }

    public function cancel() {
        $this->reset(['title', 'image']);
    }
    public function submit()
    {
        try {
            $this->validate([
                'title' => 'required|string|max:255',
            ]);

        } catch (Exception $e) {
            $this->dispatch('alert_warning', "Alt kateqoriya adını yazın");
            return;
        }

        if (!$this->selected_category) {
            $this->dispatch('alert_warning', "Kateqoriya seçin");
            return;
        }

        $new_id = DB::table('car_part_sub_category')->insertGetId(
            ['name'=>$this->title, 'category_id'=>$this->selected_category]
        );

        $this->dispatch('alert_success' , 'Yeni alt kateqoriya əlavə olundu!');

        $this->reset(['title', 'image']);
    

        // Handle the image upload if there's a file
        // if ($this->image) {
        //     $random_id = Str::random(10);

        //     $date_now = Carbon::now()->format('d_m_Y');
    
        //     $filename = $date_now .'_'. $random_id .'.'. $this->image->getClientOriginalExtension();
    
        //     $path = $this->image->storeAs('images/car-part/'.$this->selected_category, $filename, 'public');
            

        //     DB::table('image')->insert(
        //         ['sub_category_id'=>$new_id, 'image'=>$path]
        //     );
    

            
        // } else {
        //     $this->dispatch('alert_warning' , 'Şəkil seçin');
        // }
    }

    public function get_category() {
        $this->all_category = DB::table('car_part_category')->get();
    }
    
    public function get_sub_category() {
        $this->all_sub_category = DB::table('car_part_sub_category')
        ->join('car_part_category','car_part_sub_category.category_id','=','car_part_category.id')
        ->select(['car_part_sub_category.*', 'car_part_category.name as category'])
        ->get();

        $this->print($this->all_sub_category);

        $this->all_sub_category_count = DB::table('car_part_sub_category')->count();
    }

    function print($msg) {
        $this->dispatch('print', ['message'=>$msg]);
    }

    public function render()
    {
        $this->get_category();
        $this->get_sub_category();
        return view('admin.livewire.manage-sub-category');
    }
}
