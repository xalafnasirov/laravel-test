<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class SendOrderConfirmationEmail implements ShouldQueue
{
    use Queueable;
    private $order;
    private $order_detail;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $req)
    {
        // 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->get_order($this->req['order_id']);

        $order = $this->order;
        $order_detail = $this->order_detail;

        $workspaceId = "fef55458-e1ea-474d-8aba-23c50c274828";
        $channelId = "499baace-9881-5524-8c93-076f3cbd3b8c";
        $accessKey = env('CHANNEL_ACCESS_KEY'); // Store your access key in .env

        $url = "https://nest.messagebird.com/workspaces/{$workspaceId}/channels/{$channelId}/messages";

        Http::withHeaders([
            'Authorization' => 'AccessKey ' . $accessKey, // Add the authorization header
            'Content-Type' => 'application/json' // Set content type
        ])
            ->post($url, [
                'receiver' => [
                    'contacts' => [
                        [
                            'identifierValue' => $this->req['to'] // Change this to the actual recipient email
                        ]
                    ]
                ],
                'body' => [
                    'type' => 'html',
                    'html' => [
                        'metadata' => [
                            'subject' => 'Sifarişiniz #' . $this->req['order_key'] // Subject of the email
                        ],
                        'html' => view('templates.OrderConfirmationEmail', compact('order', 'order_detail'))->render(), // HTML body
                        'text' => 'Hello' // Plain text body
                    ]
                ]
            ]);


        Http::withHeaders([
            'Authorization' => 'AccessKey ' . $accessKey, // Add the authorization header
            'Content-Type' => 'application/json' // Set content type
        ])
            ->post($url, [
                'receiver' => [
                    'contacts' => [
                        [
                            'identifierValue' => 'hyunglobalaz@gmail.com' // Change this to the actual recipient email
                        ]
                    ]
                ],
                'body' => [
                    'type' => 'html',
                    'html' => [
                        'metadata' => [
                            'subject' => 'Yeni sifariş! #' . $this->req['order_key'] // Subject of the email
                        ],
                        'html' => view('templates.NewOrderForAdminEmail', compact('order'))->render(), // HTML body
                        'text' => 'Hello' // Plain text body
                    ]
                ]
            ]);
    }

    public function get_order($order_id)
    {
        $this->order = DB::table('user_order')
            ->join('payment_type', 'user_order.payment_type_id', '=', 'payment_type.id')
            ->join('status', 'user_order.status_id', '=', 'status.id')
            ->join('region', 'user_order.region_id', '=', 'region.id')
            ->select(['user_order.*', 'payment_type.name as payment_type', 'status.name as status', 'region.name as region'])
            ->where([
                'user_order.id' => $order_id
            ])->first();

        $this->order_detail = DB::table('cart')
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->join('car_part_detail', 'product.detail_id', '=', 'car_part_detail.id')
            ->join('car_brand', 'car_part_detail.brand_id', '=', 'car_brand.id')
            ->join('car_part_category', 'car_part_detail.category_id', '=', 'car_part_category.id')
            ->join('car_part_sub_category', 'car_part_detail.sub_category_id', '=', 'car_part_sub_category.id')
            ->select(['cart.*', 'car_brand.name as brand', 'car_part_category.name as category', 'car_part_sub_category.name as part_name',])
            ->where([
                'cart.order_id' => $this->order->id
            ])->get();
    }
}
