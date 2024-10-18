<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function shop_index()
    {
        return view("services.shop");
    }

    public function tire_index() {
        return view ("services.tires");
    }

    public function shop_single($id)
    {
        return view('services.single_product', ['id' => $id]);
    }

    public function cart_create()
    {
        return view('services.cart');
    }

    public function inspection_create()
    {
        return view('services.inspection');
    }

    public function inspection_store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'brand' => ['required', 'integer'],
            'phone' => ['required', 'string', 'min:9', 'max:13'],
        ]);

        $data = null;

        if ($validator->fails()) {
            $data = [
                'message' => 'request failed',
                'status' => 'error'
            ];
        } else {
            $data = [
                'message' => 'succesfully sent',
                'status' => 'success'
            ];
        }




        return view('services.inspection', compact('data'));
    }

    public function checkout_create()
    {
        return view('services.checkout');
    }

    public function confirmation_create($order_id)
    {

        // request()->validate([
        //     'order_id'=> 'integer',
        // ]);

        // if (!DB::table('user_order')->where('id', $order_id)->exists()) {
        //     return redirect()->back();
        // }

        // $data = null;

        // if (Auth::guard('web')->check()) {
        //     $user_id = Auth::guard('web')->id();

        //     $data = DB::table('user_order')
        //     ->where([
        //         'id'=> $order_id,
        //         'user_id'=> $user_id,
        //     ]);

        // } else {
        //     $cart_token = Session::get('cart_token');
        //     if ($cart_token !== null) {
        //         $data = DB::table('user_order')
        //     ->where([
        //         'id'=> $order_id,
        //         'guest_token'=> $cart_token,
        //     ]);
        //     } else {
        //         return redirect()->route('login');
        //     }
        // }

        // if ($data === null) {
        //     return redirect()->back();
        // }

        // dd($data);

        $order = DB::table('user_order')
            ->join('payment_type', 'user_order.payment_type_id', '=', 'payment_type.id')
            ->join('status', 'user_order.status_id', '=', 'status.id')
            ->join('region', 'user_order.region_id', '=', 'region.id')
            ->select(['user_order.*', 'payment_type.name as payment_type', 'status.name as status', 'region.name as region'])
            ->where([
                'user_order.id' => $order_id
            ])->first();

        $order_detail = DB::table('cart')
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->join('car_part_detail', 'product.detail_id', '=', 'car_part_detail.id')
            ->join('car_brand', 'car_part_detail.brand_id', '=', 'car_brand.id')
            ->join('car_part_category', 'car_part_detail.category_id', '=', 'car_part_category.id')
            ->join('car_part_sub_category', 'car_part_detail.sub_category_id', '=', 'car_part_sub_category.id')
            ->select(['cart.*', 'car_brand.name as brand', 'car_part_category.name as category', 'car_part_sub_category.name as part_name',])
            ->where([
                'cart.order_id' => $order->id
            ])->get();


        return view('services.confirmation', compact('order', 'order_detail'));
    }

    public function contact_create()
    {
        return view('services.contact');
    }

    public function send_email(Request $request) {

        $workspaceId = "fef55458-e1ea-474d-8aba-23c50c274828";
        $channelId = "499baace-9881-5524-8c93-076f3cbd3b8c";
        $accessKey = env('CHANNEL_ACCESS_KEY'); // Store your access key in .env

        $url = "https://nest.messagebird.com/workspaces/{$workspaceId}/channels/{$channelId}/messages";

        $response = Http::withHeaders([ 
            'Authorization' => 'AccessKey ' . $accessKey, // Add the authorization header
            'Content-Type' => 'application/json' // Set content type
        ])
            ->post($url, [
                'receiver' => [
                    'contacts' => [
                        [
                            'identifierValue' => 'khalafnasirov@gmail.com' // Change this to the actual recipient email
                        ]
                    ]
                ],
                'body' => [
                    'type' => 'html',
                    'html' => [
                        'metadata' => [
                            'subject' => 'Hello!' // Subject of the email
                        ],
                        'html' => '<p>Congratulations Khalaf Nasirov, you just sent an email with Bird! You are truly awesome!</p>', // HTML body
                        'text' => 'Congratulations Khalaf Nasirov, you just sent an email with Bird! You are truly awesome!' // Plain text body
                    ]
                ]
            ]);

        if ($response->successful()) {

            return back()->with('data', $response);
        } else {
            return back()->with('data', $response); 
        }

    }

    public function login_test() {
        return view('account.login');
    }


    public function dashboard_go($panel) {
        return view('dashboard', ['panel'=>$panel]);
    }

    public function dashboard() {
        return view('dashboard');
    }
}
