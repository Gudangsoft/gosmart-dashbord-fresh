<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ClassMenu;
use App\Models\Order;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

    }

    public function show(Order $order)
    {
        // dd($order);
        $snapToken = $order->snap_token;
        // dd($snapToken);
        if (empty($snapToken)) {
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
            // dd($midtrans);
            $order->snap_token = $snapToken;
            $order->save();
        }
        return view('member.orders.sanbox', compact('order', 'snapToken'));
    }

    public function post(Request $req)
    {
        try {
            $notification_body = json_decode($req->getContent(), true);
            $invoice = $notification_body['order_id'];
            $transaction_id = $notification_body['transaction_id'];
            $status_code = $notification_body['status_code'];

            $order = Order::where('invoice', $invoice)->where('transaction_id', $transaction_id)->first();
                        if (!$order)
                            return ['code' => 0, 'messgae' => 'Terjadi kesalahan | Pembayaran tidak valid'];
            switch ($status_code) {
                            case '200':
                                $order->status = "SUCCESS";
                                break;
                            case '201':
                                $order->status = "PENDING";
                                break;
                            case '202':
                                $order->status = "CANCEL";
                                break;
                        }
            $order->save();
                        return response('Ok', 200)->header('Content-Type', 'text/plain');
                    } catch (\Exception $e) {
            return response('Error', 404)->header('Content-Type', 'text/plain');
        }
    }


}
