<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use function GuzzleHttp\json_encode;

class VirtualPayment extends Controller
{
    public function virtualAccountMidtrans(Request $request){
        // dd($request);
        $client = New Client();
        $response = $client->post('https://api.sandbox.midtrans.com/v2/charge',
            [
                'header' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic U0ItTWlkLXNlcnZlci0zQ0h6YjdHdWk5VzFnQzd4UHA5S3A1NW0=',
                    'Content-type' => 'application/json'
                ],
                'body' => json_encode([
                    'payment_type' => 'bank_transfer',
                    'transaction_details' => [
                        'order_id' => 'va-midtrans-'.time(),
                        'gross_amount' => $request->price
                    ],
                    'bank_transfer' => [
                        'bank' => $request->bank
                    ]
                ])

            ]
        );

        $data = json_decode($response->getBody());
        return response()->json($data);
    }
}
