<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LearningController;
use App\Models\Cart;
use App\Models\ClassMenu;
use App\Models\ClassRequest;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    public function payStatus($id){
        $data = array();
        $verified = User::where('id', auth()->user()->id)->where('email_verified_at', '!=' , null)->first();

        // dd($verified);
        if(empty($verified)){
            return view('backend.user.verifikasi');
        }else{
            $class = ClassMenu::where('class_id', $id)->where('status', 'p')->first();
            $class_request = ClassRequest::where('class_id', $id)->where('member_id', auth()->user()->id)->where('status', 'p')->first();
            $order = Order::where('number', $id)->first();

            if(empty($class_request)){
                $data['pay_image'] = '/public/home-images/pay_image/default.jpg';
            }else{
                if(empty($order)){
                    $data['pay_image'] = '/public/home-images/kelas/thumbnail/default.jpg';
                    $data['pay_page'] = '#';
                }else{
                    $data['pay_image'] = '/public/home-images/kelas/thumbnail/'.$class->image;
                    $data['pay_page'] = route('cart.reorder-page', $id);
                }
            }

            if(!empty($class_request)){
                $dateOne                = $class_request->updated_at;
                // $dateOne                = '2022-05-22 12:00';
                $countHoursExpired      = Carbon::now()->diffInHours($dateOne, true);
                $maxExpired             = 24;
                $leftHours              = $maxExpired - $countHoursExpired;

                $data['class']['left']  = $leftHours;
                $data['class']['date']  = Carbon::parse($class_request->updated_at)->isoFormat('dddd, D MMMM Y');

                if($class_request->premium == true){
                    $data['paid'] = "LUNAS";
                }else{
                    if($countHoursExpired > 24){
                        $data['paid'] = "EXPIRED";
                    }else{
                        $data['paid'] = "PENDING";
                    }
                }

                $data['class']['url']       = '/learning/class_learn/'.$class->slug;
                $data['class']['id']        = $id ;
                $data['class']['title']     = strtoupper($class_request->getClass->name);
                $data['class']['discount']  = $class->discount;
                $data['class']['price']     = 'Rp '.number_format(Cart::where('user_id', auth()->user()->id)->where('class_id', $id)->first()->price);
                $data['pay_class']['class'] = $data['class'];
                // dd($data);
            }else{
                return redirect('/learning/dashboard/'.auth()->user()->id)->with('pay_status', 'Your Class Not Found');
            }

        }


        $data['profile'] = LearningController::profile();
        $data['url_history']   = '/learning/tab-menu/history';

        return view('member.dashboard.pay_status', compact('data'));
    }
}
