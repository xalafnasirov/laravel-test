<?php

namespace App\Livewire\Admin\Ecommerce;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminCompletedOrders extends Component
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

    public function get_status()
    {
        $this->status = DB::table('status')->get();
    }

    public function get_payment_type()
    {
        $this->payment_type = DB::table('payment_type')->get();
    }

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

        $this->all_order = DB::table("user_order")
            ->join('payment_type', 'user_order.payment_type_id', '=', 'payment_type.id')
            ->join('status', 'user_order.status_id', '=', 'status.id')
            ->select([
                'user_order.*',
                'payment_type.name as payment_type',
                'status.name as status'
            ])
            ->when($this->search_status, function ($query) {
                $query->where(function ($query) {
                    $query->where([
                        'user_order.status_id' => $this->search_status
                    ]);
                });
            })
            ->when($this->search_payment_type, function ($query) {
                $query->where(function ($query) {
                    $query->where([
                        'user_order.payment_type_id' => $this->search_payment_type
                    ]);
                });
            })
            ->when(!empty($this->search_phone), function ($query) {
                $query->where(function ($query) {
                    $query->where('user_order.phone', 'LIKE', '%' . $this->search_phone . '%');
                });
            })
            ->when(!empty($this->search_order_key), function ($query) {
                $query->where(function ($query) {
                    $query->where('user_order.order_key', 'LIKE', '%' . $this->search_order_key . '%');
                });
            })
            ->when(!empty($this->search_customer), function ($query) {
                $query->where(function ($query) {
                    $query->where('user_order.firstname', 'LIKE', '%' . $this->search_customer . '%')
                    ->orWhere('user_order.lastname', 'LIKE', '%' . $this->search_customer . '%');
                });
            })
            ->offset($this->get_offset())
            ->limit($this->page_limit)
            ->get();

        $this->all_order_count = DB::table('user_order')->count();
    }

    // Search payment type
    public $search_payment_type;
    public function updatedSearchPaymentType()
    {
        $this->get_orders();
    }

    // Search status
    public $search_status;
    public function updatedSearchStatus()
    {
        $this->get_orders();
    }

    // Search Date

    // Phone search
    public $search_phone;
    public function updatedSearchPhone()
    {
        $this->get_orders();
    }

    // Search order key
    public $search_order_key;
    public function updatedSearchOrderKey()
    {
        $this->get_orders();
    }

    // Search customer
    public $search_customer;
    public function updatedSearchCustomer()
    {
        $this->get_orders();
    }

    public function mount()
    {
        $this->get_status();
        $this->get_payment_type();
        $this->get_orders();
    }

    public function render()
    {
        $this->get_pagination();
        return view('admin.livewire.ecommerce.admin-completed-orders');
    }
}
