<?php

namespace App\Livewire\Admin\Ecommerce;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Users extends Component
{
    public $all_user;
    public $all_user_count;
    public $page_limit = 10;
    public $page_count;
    public $current_page = 1;
    public $start_position = 0;

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
        if ($this->all_user_count != 0) {
            $this->page_count = ceil($this->all_user_count / $this->page_limit);
        }
    }

    public function get_user_order() {}


    public function get_users()
    {

        // $this->all_user = DB::table("users")
        // ->select(['users.id', 'users.name', 
        // 'users.email', 'users.phone', 
        // 'users.email_verified_at', 'users.created_at'])
        // ->offset( $this->get_offset() )
        // ->limit($this->page_limit)
        // ->get();

        $this->all_user = DB::table("users")
            ->leftJoin('user_order', 'users.id', '=', 'user_order.user_id')
            ->join('address', 'address.user_id', '=', 'users.id')
            ->select([
                'users.id',
                'users.email',
                'users.phone',
                'users.email_verified_at',
                'users.created_at',
                'address.firstname as firstname',
                'address.lastname as lastname',
                DB::raw('COUNT(user_order.id) as order_count')
            ])
            ->groupBy(
                'users.id',
                'users.email',
                'users.phone',
                'users.email_verified_at',
                'users.created_at',
                'address.firstname',
                'address.lastname',
            ) // Group by all selected fields
            ->offset($this->get_offset())
            ->limit($this->page_limit)
            ->get();
            
        // foreach ($this->all_user as $user) {
        //     $user->order_count = 1;
        // }

        // dd($this->all_user);

        $this->all_user_count = DB::table('users')->count();
    }

    public function render()
    {
        $this->get_users();
        $this->get_pagination();
        return view('admin.livewire.ecommerce.users');
    }
}
