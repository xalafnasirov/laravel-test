<?php

namespace App\Livewire\Admin\Ecommerce;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CarRequestAdmin extends Component
{
    public $all_order;
    public $all_order_count;
    public $page_limit = 10;
    public $page_count;
    public $current_page = 1;
    public $start_position = 0;
    public $status;
    public $payment_type;
    public $edit_status;



    public function get_offset(): int
    {
        if ($this->current_page > 0) {
            return ($this->current_page - 1) * $this->page_limit;
        } else {
            return 0;
        }
    }

    public function on_edit_status_change($id = null)
    {
        if ($id === null) {
            return;
        }

        DB::table('user_order')
            ->where('id', $id)
            ->update([
                'status_id' => $this->edit_status,
            ]);
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
        if ($this->all_order_count != 0) {
            $this->page_count = ceil($this->all_order_count / $this->page_limit);
        }
    }


    public function get_orders()
    {

        $this->all_order = DB::table("request")
            ->join('request_detail', 'request.id', '=', 'request_detail.request_id')
            ->join('car_brand', 'request_detail.brand_id', '=', 'car_brand.id')
            ->select([
                'request.*',
                'car_brand.name as brand',
                'request_detail.year as year',
                'request_detail.customer as customer',
                'request_detail.phone as phone',
                'request_detail.fuel_type as fuel_type'
            ])
            ->when(!empty($this->search_phone), function ($query) {
                $query->where(function ($query) {
                    $query->where('request_detail.phone', 'LIKE', '%' . $this->search_phone . '%');
                });
            })
            ->when(!empty($this->search_customer), function ($query) {
                $query->where(function ($query) {
                    $query->where('request_detail.customer', 'LIKE', '%' . $this->search_customer . '%');
                });
            })
            ->offset($this->get_offset())
            ->limit($this->page_limit)
            ->get();


        $this->all_order_count = DB::table('request')->count();
    }

    // Date search
    public $search_date;

    public function updatedSearchDate() {
        dd($this->search_date);
    }

    // Phone search
    public $search_phone;
    public function updatedSearchPhone() {
        $this->get_orders();
    }

    // Customer search
    public $search_customer;
    public function updatedSearchCustomer() {
        $this->get_orders();
    }



    public function remove($id = null) {

        if ($id === null) {
            return;
        }

        DB::table('request')->delete($id);

    }

    public function mount()
    {
        $this->get_orders();
    }

    public function render()
    {
        $this->get_pagination();
        return view('admin.livewire.ecommerce.car-request-admin');
    }
}
