<?php

namespace App\Services\Midtrans;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Midtrans\Snap;

class CreatePaymentUrlService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    // https://dev.to/martinms/integrate-midtrans-in-laravel-with-snap-api-part-1-18g8
    // https://dev.to/martinms/midtrans-and-laravel-8-integration-using-snap-part-2-4d53

    public function getPaymentUrl()
    {
        $itemDetails = new Collection();

        foreach ($this->order->orderItems as $item) {
            $product = Product::find($item->product_id);

            $itemDetails->push([
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => $item->quantity,
                'name' => $product->name,
            ]);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $this->order->number,
                'gross_amount' => $this->order->total_price,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $this->order->user->name,
                'email' => $this->order->user->email,
            ]
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        return $paymentUrl;
    }
}
