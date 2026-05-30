<?php

namespace App\Http\Controllers\Api;

use App\chanel;
use App\Http\Controllers\Controller;
use App\Models\ClassHistory;
use Illuminate\Http\Request;
use App\Models\ClassRequest;
use App\Models\ClassMenu;
use App\Models\PaymentModel;
use App\Models\ProfileGacademy;
use App\Models\SkillModel;
use App\Models\UserData;
use App\User;
use App\view_stream;
use Carbon\Carbon;

class ApiDashboard extends Controller
{
    public function index()
    {
        //
    }

    public function dataUserDashboard($id)
    {
        $data = array();
        $app = ProfileGacademy::where('id', 1)->where('status', 'p')->first();
        $data['app'] = [
            'id' => $app->id,
            'name' => $app->name,
            'email' => $app->email,
            'phone' => $app->hp,
            'url' => $app->link,
            'address' => $app->address,
            'logo' => '/home-images/app/'.$app->logo,
        ];

        // check class
        $user = User::where('id', $id)->first();
        $role = $user->role;

        $data['id']   = $user->id;
        $data['url']   = '/learning/profile/'.$user->name;
        $data['name']   = $user->name;
        $data['email']  = $user->email;
        $data['phone']  = $user->phone;
        $data['address']  = ucwords($user->address);
        $data['check_class'] = ClassMenu::where('add_by', $id)->first();

        if($user->photo == null){
            $data['photo']  = '/img/user/s7.png';
        }else{
            $data['photo']  = '/img/user/'.$user->photo;
        }
        $data['address']  = $user->address;
        if($role == 'teacher'){
            $data['role']  = 'mentor';
        }else{
            $data['role']  = $user->role;
        }
        // dd($data);

        if ($user->role == 'admin' || $user->role == 'teacher') {
            $user_data = UserData::where('user_id', $id)->first();
            $payment_data = PaymentModel::where('user_id', $id)->first();

            if (empty($user_data)) {
                $data['bio'] = "Bio masih kosong, tambahkan sekarang";
                $data['education'] = '';
                $data['skill'] = '';
            } else {
                $data['bio'] = $user_data->bio;
                $data['education'] = $user_data->education;
                $data['skill'] = $user_data->expert;
                // $data['skill_list'] = explode(",", $user_data->expert);
            }
            // dd($user_data);

            if (empty($payment_data)) {
                $data['bank'] = '';
                $data['no_rekening'] = '';
                $data['owner_name'] = '';
            } else {
                $data['bank'] = $payment_data->bank_name;
                $data['no_rekening'] = $payment_data->no_rekening;
                $data['owner_name'] = $payment_data->owner_name;
            }


            // TOTAL CLASS
            $total_all = ClassMenu::all()->count();
            $total_class = ClassMenu::where('add_by', $id)->get()->count();
            // dd($total_class);
            $data['total_class'] = $total_class;
            if($total_all > 0 && $total_class > 0){
                $data['precent_class'] = ($total_class/$total_all)*100;
            }else{
                $data['precent_class'] = 0;

            }

            // TOTAL PELANGGAN
            $total_class_pelanggan = ClassMenu::where('add_by', $id)->pluck('class_id');
            $total_pelanggan_all = ClassRequest::all()->count();
            $total_pelanggan = ClassRequest::whereIn('class_id', $total_class_pelanggan)->where('premium', true)->get()->count();
            $data['total_pelanggan'] = $total_pelanggan;
            if($total_pelanggan_all > 0 && $total_pelanggan > 0){
                $data['precent_pelanggan'] = $total_pelanggan/$total_pelanggan_all*100;
            }else{
                $data['precent_pelanggan'] = 0;
            }

            // INCOME
            $total_pelanggan_premium = ClassRequest::where('premium', true)->get();
            $income_class = ClassRequest::whereIn('class_id', $total_class_pelanggan)->where('premium', true)->get();
            // dd($income_class);
            if(empty($income_class[0])){
                $data['total_income'] = 0;
            }else{
                foreach ($income_class as $k => $v) {
                    $data['date_year']['year'][$k] = Carbon::createFromFormat('Y-m-d H:i:s', $v->created_at)->format('Y');
                    $data['income']['in'][$k] = $v->getClass->price;
                }
                $data['data_income'] = array_merge($data['date_year'], $data['income']);
                $data['total_income'] = number_format(array_sum($data['income']), 0, ',', '.'); //jumlahkan value array
            }


            // TOTAL MATERI
            $channel = chanel::where('id_user', $id)->first();
            if(!empty($channel)){
                $arr_id_materi = view_stream::where('chanel_id', $channel->id)->pluck('id');
                $rate = ClassHistory::whereIn('materi_id', $arr_id_materi)->get()->avg('rating');
                $total_materi = view_stream::where('chanel_id', $channel->id)->get()->count();
                $data['total_materi'] = $total_materi;
                if (empty($rate)) {
                    $data['rate'] = 0;
                } else {
                    $data['rate'] = $rate;
                }
            }else{
                $data['total_materi'] = 0;
                $data['rate'] = 0;

            }

            // SKILL
            $skill = SkillModel::where('user_id', $id)->first();
            // dd($skill);
            if(empty($skill)){
                $data['skill_list'] = null;
            }else{
                $data['skill_list'] = json_decode($skill->skill);
            }


            // dd($data);
            // dd($rate);
        }
        // dd($data);
        return response()->json($data, 200);
    }

    public function Statistics(){
        $dateTime       = date('Y-m-d H:i:s');

        $user           = User::whereNotNull('email_verified_at')->get()->count();
        $materi         = view_stream::where('status', 'p')->get()->count();
        $class          = ClassMenu::where('status', 'p')->get()->count();
        $class_free     = ClassMenu::where('status', 'p')
                            ->where('premium', false)
                            ->get()
                            ->count();
        $class_premium  = ClassMenu::where('status', 'p')
                            ->where('premium', true)
                            ->get()
                            ->count();

        $data = [
            'date' => $dateTime,
            'total_user' => $user,
            'total_class' => [
                'free' => $class_free,
                'premium' => $class_premium,
                'all' => $class
            ],
            'total_materi' => $materi,
        ];

        return response()->json($data, 200);
    }
}
