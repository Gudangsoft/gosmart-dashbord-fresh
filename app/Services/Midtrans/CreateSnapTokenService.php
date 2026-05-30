<?php

// namespace App\Services\Midtrans;

// use Midtrans\Snap;

// class CreateSnapTokenService extends Midtrans
// {
//     protected $order;

//     public function __construct($order, $data_class)
//     {
//         parent::__construct();

//         $this->order = $order;
//         $this->data_class = $data_class;
//         // dd($order);
//     }

//     public function getSnapToken()
//     {
//         $params = [
//             'transaction_details' => [
//                 'order_id' => rand(10, 100) ,
//                 'gross_amount' => 10000,
//             ],
//             'item_details' => [
//                 [
//                     'id' => $this->data_class->class_id,
//                     'price' => $this->data_class->price,
//                     'quantity' => 1,
//                     'name' => strtoupper($this->data_class->name),
//                 ]

//             ],
//             'customer_details' => [
//                 'first_name' => $this->order->name,
//                 'email' => $this->order->email,
//                 // 'phone' => null,
//             ]
//         ];
//         // dd($params);
//         $snapToken = Snap::getSnapToken($params);

//         return $snapToken;
//     }
// }

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($user, $order)
    {
        parent::__construct();

        $this->user     = $user;
        $this->order    = $order;
    }

    public function getSnapToken()
    {
        // dd($this->order);
        foreach ($this->order as $k => $v) {
            $total_caracter =  strlen($v->getClass->name);
            if($total_caracter > 47){
                $name = substr($v->getClass->name, 0, 47).'...';
            }else{
                $name = $v->getClass->name;
            }

            $data[$k]['price']      = $v->price;
            $data[$k]['id']         = $v->class_id;
            $data[$k]['quantity']   = 1;
            $data[$k]['name']       = $name;
        }

        $params = [
            'transaction_details' => [
                'order_id'      => rand(1, 10000),
                'gross_amount'  => rand(10000, 100000),
            ],
            'item_details'      => $data,
            'customer_details'  => [
                'first_name'    => $this->user->name,
                'email'         => $this->user->email,
                'phone'         => $this->user->phone,
            ]
        ];
        // dd($params);
        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
