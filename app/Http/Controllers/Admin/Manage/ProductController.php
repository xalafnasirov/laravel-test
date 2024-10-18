<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show_brand() {
        return view("admin.manage.brand");
    }

    public function show_category() {
        return view("admin.manage.category");
    }

    public function show_sub_category() {
        return view("admin.manage.sub_category");
    }

    public function show_car_part() {
        return view("admin.manage.car_part");
    }

    public function show_tire_brand() {
        return view("admin.manage.tire_brand");

    }

    public function show_tire() {
        return view("admin.manage.tire");
    }
}
