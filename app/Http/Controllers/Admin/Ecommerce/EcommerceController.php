<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EcommerceController extends Controller
{
    public function users_index() {
        return view('admin.ecommerce.users');
    }
    public function orders_index() {
        return view('admin.ecommerce.orders');
    }

    public function completed_orders_index() {
        return view('admin.ecommerce.completed-orders');
    }

    public function order_show($id) {
        $validator = Validator::make(['id'=> $id],  
        [
            'id'=>'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Not valid id');
        }

        $order = DB::table('user_order')
        ->join('payment_type', 'user_order.payment_type_id', '=', 'payment_type.id')
        ->join('status', 'user_order.status_id', '=', 'status.id')
        ->join('region', 'user_order.region_id', '=', 'region.id')
        ->select(['user_order.*', 'payment_type.name as payment_type', 'status.name as status', 'region.name as region'])
        ->where([
            'user_order.id' => $id
        ])->first();

    $order_detail = DB::table('cart')
        ->join('product', 'cart.product_id', '=', 'product.id')
        ->join('car_part_detail', 'product.detail_id', '=', 'car_part_detail.id')
        ->join('car_brand', 'car_part_detail.brand_id', '=', 'car_brand.id')
        ->join('car_part_category', 'car_part_detail.category_id', '=', 'car_part_category.id')
        ->join('car_part_sub_category', 'car_part_detail.sub_category_id', '=', 'car_part_sub_category.id')
        ->select(['cart.*', 'car_brand.name as brand', 'car_part_category.name as category', 'car_part_sub_category.name as part_name',])
        ->where([
            'cart.order_id' => $id,
            'status'=>'purchased'
        ])->get();
        return view('admin.ecommerce.single_order', compact('order', 'order_detail'));
    }

    public function car_requests_index() {
        return view('admin.ecommerce.car_request');
    }
}
