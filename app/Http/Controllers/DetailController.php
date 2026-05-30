<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Model\LogoMitra;
use App\Models\Certificate;
use App\Models\ChannelData;
use App\Models\ClassCategory;
use App\Models\ClassHistory;
use App\Models\ClassLinkage;
use App\Models\ClassMenu;
use App\Models\ClassRequest;
use App\Models\Cart;
use App\Models\LiveStream;
use App\Models\ProfileGacademy;
use App\Models\ReviewClassModel;
use App\Models\SkillModel;
use App\Models\ToolsMateri;
use App\Models\UserData;
use App\Models\Event;
use App\Models\EventRegisted;
use App\Models\PagesModel;
use App\Models\User;
use App\view_stream;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;
use DB;

use Prophecy\Prophecy\Revealer;

class DetailController extends Controller
{
    public function toolsMateri(){
        $data = array();
        $rows = ToolsMateri::orderBy('created_at', 'desc')->get();
        $rows_user_id = ToolsMateri::orderBy('created_at', 'desc')->get();
        foreach($rows_user_id as $k=>$v){
            $data[$k]['user_id'] = $v->user_id;
            if($data[$k]['user_id'] == auth()->user()->id){
                $data['opsi'] = true;
            }else{
                $data['opsi'] = false;
            }
        }
        // dd($data);
        $channel_cek = DashboardController::channelCek();
        $profile = DashboardController::userData(auth()->user()->id);

        return view('backend.tools_materi.index', compact('channel_cek', 'profile', 'rows', 'data'));
    }

    public static function DataChannel($limit){
        $data = array();
        $row = ChannelData::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate($limit);
        foreach ($row as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['materi_id'] = $v->getMateri->id;
            $data[$k]['title'] = $v->getMateri->judul;
            $data[$k]['visitor'] = $v->getMateri->visitor;
            $data[$k]['premium'] = $v->getMateri->premium;
            $data[$k]['status'] = $v->getMateri->status;
            $data[$k]['class'] = ucfirst($v->getClass->name);
            $data[$k]['date'] = $v->created_at;
        }

        return $data;
    }

    public static function user($id){
        $user = User::where('id', $id)->whereNotNull('email_verified_at')->first();

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role,
            'address' => $user->address,
            'photo' => $user->photo,
        ];

        return $data;

    }

    public function mentorDetail($slug){
        $data = array();

        $data['mentor'] = self::userDetail($slug);

        $data['meta']           = DetailController::metaData($slug, null, null, null, null);
        $data['data']           = Advertisement::AdvText();
        $data['categories']     = DetailController::Categories(6);
        $data['cart_count']         = isset(auth()->user()->id) ? Cart::where('user_id', auth()->user()->id)->where('status', 1)->count() : '';


        return view('member.mentor.detail', compact('data'));
    }

    public static function classRequest($user_id){
        $data = array();
        $class = ClassRequest::where('member_id', $user_id)->where('status', 'p')->orderBy('created_at', 'desc')->paginate(8);
        // dd($class);
        $data['page'] = $class;
        if(isset($class)){
            foreach ($class as $k => $v) {
                if(empty($v->getClass->image)){
                    $image = '/home-images/kelas/thumbnail/default.jpg';
                }else{
                    $image = '/home-images/kelas/thumbnail/'.$v->getClass->image;
                }
                $data['data'][$k]['total_discount']     = $v->getClass->discount;
                $data['data'][$k]['price']              = isset($v->getClass->discount) ? ('Rp '.number_format(($v->getClass->price - ($v->getClass->discount/100*$v->getClass->price)),0,',','.')) : ('Rp '.number_format($v->getClass->price, 0,',','.'));

                $last = ClassHistory::where('class_id', $v->class_id)->latest()->first();
                $first_learn = view_stream::where('class_id', $v->class_id)->first();
                if(isset($last)){
                    $m = view_stream::where('id', $last->materi_id)->value('slug');
                }else{
                    $m = $first_learn->slug;
                }

                if($v->premium == true){
                    $paid = "PAID";
                    $url = '/learning/content/'.$m;
                }else{
                    $paid = "PENDING";
                    $url = '/class/'.$v->getClass->slug;
                }

                $data['data'][$k]['id'] = $v->class_id;
                $data['data'][$k]['title'] = strtoupper($v->getClass->name);
                $data['data'][$k]['url'] = $url;

                $data['data'][$k]['count_subs'] = ClassRequest::where('class_id', $v->getClass->class_id)->where('premium', true)->get()->count();
                $data['data'][$k]['image'] = $image;
                $data['data'][$k]['paid'] = $paid;
                // $data['data'][$k]['price'] = $v->getClass->price;
            }
        }
        // dd($data);
        return $data;
    }

    //
    public static function classList($user_id, $id){
        $class = classMenu::where('status', 'p');

        if(empty($id)){
            $class = $class->where('add_by', $user_id);
        }
        $class = $class->orderBy('created_at')->paginate(8);


        // dd($class);
        $data = array();
        $data['page'] = $class;
        foreach ($class as $k => $v) {
            if(empty($v->image)){
                $image = '/home-images/kelas/thumbnail/default.jpg';
            }else{
                $image = '/home-images/kelas/thumbnail/'.$v->image;
            }
            $data['data'][$k]['id'] = $v->class_id;
            $data['data'][$k]['url'] = '/class/'.$v->slug;
            $data['data'][$k]['name'] = ucfirst($v->name);
            $data['data'][$k]['count_subs'] = ClassRequest::where('class_id', $v->class_id)->where('premium', true)->get()->count();
            $data['data'][$k]['image'] = $image;
            $data['data'][$k]['price'] = $v->price;
        }

        // CLASS SELECTED


        return $data;
    }

    public static function ReviewMateri($id, $limit){
        $review = ClassHistory::where('materi_id', $id)->where('status', 'p')
                    ->orderBy('created_at', 'desc')->paginate($limit);

        $data = array();
        if(!empty($review)){
            foreach ($review as $k => $v) {
                $data[$k]['id'] = $v->id;
                $data[$k]['username'] = ucwords($v->getUser->name);
                if($v->getUser->photo == null){
                    $data[$k]['photo']  = '/img/user/s7.png';
                }else{
                    $data[$k]['photo']  = '/img/user/avatar/'.$v->getUser->photo;
                }

                // $data[$k]['photo'] = '/img/user/avatar/'.$v->getUser->photo;
                if(empty($v->review) || $v->review == null || $v->review == ""){
                    $data[$k]['review'] = "Review telah disembunyikan karena melanggar pedoman user atau komunitas";
                    $data[$k]['show']   = true;
                }else{
                    $data[$k]['review'] = html_entity_decode($v->review);
                    $data[$k]['show']   = false;
                }

                $data[$k]['rating'] = $v->rating;
                $data[$k]['date'] = date('d-m-Y', strtotime($v->created_at));
                $data[$k]['add_by'] = $v->getClass->add_by;

            }
        }

        // dd($data);
        return $data;
    }

    public static function livestreaming($id){
        $data = array();
        $data['row'] = LiveStream::where('id', $id)->first();

        return $data;
    }

    public static function livestreamings($limit){
        $data = array();
        $data['rows'] = LiveStream::where('status', 'p')->orderBy('created_at', 'desc')->paginate($limit);

        return $data;
    }

    public static function classDetail($id){
        $data = array();
        $class      = ClassMenu::where('class_id', $id)->where('status', 'p')->first();
        $subscribe  = ClassRequest::where('class_id', $class->class_id)->where('premium', true)->get()->count();
        $log        = ClassHistory::where('class_id', $class->class_id)
                        ->select('class_id', DB::raw('count(*) as total'))
                        ->groupBy('class_id')
                        ->get();
        $data_user  = UserData::where('user_id', $class->add_by)->first();
        $username   = '';

        // dd($log->items);
        if(empty($subscribe)){
            if($class->premium != '0'){
                $data['class']['total_subscribe'] = '0 Pelanggan';
            }else{
                if(empty($log[0])){
                    $data['class']['total_subscribe'] = '0 Mengikuti';
                }else{
                    $data['class']['total_subscribe'] = $log[0]['total'].' Mengikuti';
                }
            }
        }else{
            $data['class']['total_subscribe'] = $subscribe.' Pelanggan';
        }
        // dd($data);
        $data['class']['id'] = $id ;
        $data['class']['category_title']    = isset($class->getCategory) ? $class->getCategory->title : '';
        $data['class']['category_slug']     = isset($class->getCategory) ? $class->getCategory->slug : '';
        $data['class']['title'] = strtoupper($class->name);
        $data['class']['slug'] = $class->slug;
        $data['class']['url'] = '/class/'.$class->slug;

        if($class->price == 0){
            $data['class']['price'] = 'GRATIS';
        }else{
            $data['class']['price'] = 'Rp '.number_format($class->price,0,',','.');
        }

        $data['class']['total_discount']    = $class->discount;
        $data['class']['discount']          = isset($class->discount) ? ('Rp '.number_format(($class->price - ($class->discount/100*$class->price)),0,',','.')) : '0';
        $data['class']['price_default']     = isset($class->discount) ? ($class->price - $class->discount/100*$class->price) : $class->price;

        $data['class']['description'] = htmlspecialchars_decode($class->description);
        $data['class']['image'] = '/home-images/kelas/thumbnail/'.$class->image;
        $data['class']['author'] = $class->getUser->name;
        if(is_file(public_path('/img/user/avatar/'.$class->getUser->photo))){
            $data['class']['author_image'] = '/img/user/avatar/'.$class->getUser->photo;
        }else{
            $data['class']['author_image'] = '/img/user/s7.png';
        }
        $data['class']['phone'] = $class->getUser->phone;

        if(empty(auth()->user()->id)){
            $username = null;
        }else{
            $username = auth()->user()->name;
        }

        $data['class']['wa_url'] = 'https://wa.me/'.$class->getUser->phone.'?text=Halo,%20Perkenalkan%20saya%20'.$username.'%20dari%20kelas%20'.strtoupper($class->name).'%20G-Academy%20ingin%20berkonsultasi%20dengan%20mentor';
        // $data['class']['bio'] = $data_user->bio;
        $data['class']['total_materi'] = view_stream::where('class_id', $class->class_id)->count();
        $data['class']['level'] = ucfirst($class->getLevel->name);

        $payment = ProfileGacademy::where('status', 'p')->first();
        $data['payment']['username'] = $payment->main_rekening_name;
        $data['payment']['bank'] = $payment->main_rekening_bank;
        $data['payment']['number'] = $payment->main_rekening;

        $data['review'] = self::review($id, 5);

        for ($i=1; $i <= 5; $i++) {
            // $data['stars'][$i]['star'] = $i;
            // $data['stars'][$i]['star'] = $row_review_class->where('rating', '=', $i)->get()->count();
            # code...
        }


        // dd($data);
        return $data;
    }

    public static function  Contents($class_id, $slug){
        $data = array();
        $arr = array();
        $user_id = auth()->user()->id;

        // review user in last materi
        $check_last_learn = view_stream::where('slug', $slug)->value('id');
        $last_id_larn = view_stream::where('class_id', $class_id)->max('id');

        if($check_last_learn == $last_id_larn){
            $data['review'] = true;
        }else{
            $data['review'] = false;
        }
        // dd($check_last_learn);

        $rows = view_stream::where('status', 'p');
        if(!empty($class_id)){
            $rows = $rows->where('class_id', $class_id);
        }
        $rows = $rows->orderBy('id', 'asc')->get();

        $log_last           = ClassHistory::where('class_id', $class_id)->where('member_id', $user_id)->latest()->first();
        if(empty($log_last)){
            $m_id = 0;
        }else{
            $m_id = $log_last->materi_id;
        }

        $log                = ClassHistory::where('class_id', $class_id)->where('member_id', $user_id)->first();
        $count              = view_stream::where('class_id', $class_id)->orderBy('id', 'asc')->get()->count();
        $count_complete     = ClassHistory::where('class_id', $class_id)->where('member_id', $user_id)
                                ->orderBy('materi_id', 'asc')->get()->count();

        $log_all = ClassHistory::where('class_id', $class_id)->where('member_id', $user_id)->get();
        foreach ($log_all as $a => $b) {
            $arr['materi_id'] = $b->materi_id;
        }

        if($log == null){
            foreach ($rows as $k => $v) {
                $data['content'][$k]['id'] = $v->id;
                $data['content'][$k]['title'] = $v->judul;
                $data['content'][$k]['slug'] = $v->slug;
                $data['content'][$k]['url'] = '#';
                $data['content'][$k]['un_completed'] = '<i class="fa fa-lock"></i>';
                $data['content'][$k]['bg_disable'] = '';
                $data['content'][$k]['class_id'] = $v->class_id;

                // YOUTUBE API 3
                $datayt = array();
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?id='.$v->slug.'&part=contentDetails&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($result, true);
                // $data['content'][$k]['time'] =  LearningController::contentDate(round(LearningController::isoSeconds($result['items'][0]['contentDetails']['duration'])/60));
                $data['content'][$k]['time'] =  LearningController::contentDate(LearningController::isoSeconds($result['items'][0]['contentDetails']['duration']));

                $data['content'][$k]['meta']['title'] = config('app.name')." | ".$v->judul;

            }

        }else{
            foreach ($rows as $k => $v) {
                $data['content'][$k]['id'] = $v->id;
                $data['content'][$k]['title'] = $v->judul;
                $data['content'][$k]['slug'] = $v->slug;

                if($data['content'][$k]['id'] == $arr['materi_id']){
                    $data['content'][$k]['url'] = '/learning/content/'.$v->slug;
                    $data['content'][$k]['in_completed'] = '<i class="fa fa-unlock text-success"></i>';
                }else{
                    // $data['content'][$k]['in_completed'] = '<i class="fa fa-check-circle text-success"></i> Selesai';
                    if($k > $count_complete){
                        $data['content'][$k]['url'] = '#';
                        // $data['content'][$k]['un_completed'] = 'lock';
                    }else{
                        $data['content'][$k]['in_completed'] = '<i class="fa fa-unlock text-success"></i>';
                        $data['content'][$k]['url'] = '/learning/content/'.$v->slug;
                    }
                }

                $data['content'][$k]['un_completed'] = '<i class="fa fa-lock"></i>';
                $data['content'][$k]['bg_disable'] = '';
                $data['content'][$k]['class_id'] = $v->class_id;



                // YOUTUBE API 3
                $datayt = array();
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?id='.$v->slug.'&part=contentDetails&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($result, true);
                // $data['content'][$k]['time'] =  LearningController::contentDate((LearningController::isoSeconds($result['items'][0]['contentDetails']['duration'])));
                // dd(LearningController::isoSeconds('PT5M'));
                $data['content'][$k]['time'] =  LearningController::contentDate(LearningController::isoSeconds('PT5M'));

                $data['content'][$k]['meta']['title'] = config('app.name')." | ".$v->judul;

            }
            // dd($data);

        }

        // $sub_class          = ClassLinkage::where('class_parent', $class_id)->where('status', 'p')->orderBy('id', 'asc')->get();
        // dd($count_complete);
        // if(empty($sub_class[0])){
        //     $parent_class = ClassLinkage::where('class_id', $class_id)->where('status', 'p')->orderBy('id', 'asc')->get();
        //     // dd($parent_class);
        //     foreach ($parent_class as $a => $b) {
        //         $data['sub_class'][$a]['id']    = $b->id;
        //         $data['sub_class'][$a]['title'] = strtoupper($b->getParentClass->name);
        //         $data['sub_class'][$a]['time']  = LearningController::contentDate(LearningController::isoSeconds('PT3M'));

        //         if($count_complete == $count){
        //             $data['sub_class'][$a]['content'] = view_stream::where('class_id', $b->class_parent)->where('status', 'p')->orderBy('id', 'asc')->get();
        //             foreach ($data['sub_class'][$a]['content'] as $x => $y) {
        //                 $data['sub_content'][$x]['id']      = $y->id;
        //                 $data['sub_content'][$x]['title']   = $y->judul;
        //                 $data['sub_content'][$x]['slug']    = $y->slug;

        //                 $curl = curl_init();
        //                 curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?id='.$v->slug.'&part=contentDetails&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
        //                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //                 $result = curl_exec($curl);
        //                 curl_close($curl);
        //                 $result = json_decode($result, true);
        //                 // $data['sub_content'][$x]['time'] =  round(LearningController::isoSeconds($result['items'][0]['contentDetails']['duration'])/60);

        //                 $data['sub_content'][$x]['time'] = LearningController::contentDate(LearningController::isoSeconds('PT3M'));
        //             }
        //         }
        //     }
        // }else{

        //     foreach ($sub_class as $a => $b) {
        //         $data['sub_class'][$a]['id'] = $b->id;
        //         $data['sub_class'][$a]['title'] = strtoupper($b->getClass->name);
        //         $data['sub_class'][$a]['time'] = LearningController::contentDate(LearningController::isoSeconds('PT3M'));
        //         if ($count_complete == $count) {
        //             $data['sub_class'][$a]['lock']    = 'fa-unlock';
        //             $data['sub_class'][$a]['content'] = view_stream::where('class_id', $b->class_id)->where('status', 'p')->orderBy('id', 'asc')->get();
        //             foreach ($data['sub_class'][$a]['content'] as $x => $y) {
        //                 $data['sub_content'][$x]['id'] = $y->id;
        //                 $data['sub_content'][$x]['title'] = $y->judul;
        //                 $data['sub_content'][$x]['slug'] = $y->slug;

        //                 $curl = curl_init();
        //                 curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?id='.$v->slug.'&part=contentDetails&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
        //                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //                 $result = curl_exec($curl);
        //                 curl_close($curl);
        //                 $result = json_decode($result, true);
        //                 // data['sub_content'][$x]['time']'] =  round(LearningController::isoSeconds($result['items'][0]['contentDetails']['duration'])/60);

        //                 $data['sub_content'][$x]['time'] = LearningController::contentDate(LearningController::isoSeconds('PT3M'));
        //             }
        //         }
        //     }

        // }

        if(empty($slug)){
            $row = view_stream::where('class_id', $class_id)->first();
        }else{
            $row = view_stream::where('slug', $slug)->first();
        }
        $data['video_now']['id'] = $row->id;
        $data['video_now']['class_id'] = $row->class_id;
        $data['video_now']['title'] = $row->judul;
        // $data['video_now']['url'] = 'https://www.youtube.com/embed/'.$row->slug;
        $data['video_now']['url'] = $row->link.'?autoplay=1';
        $data['video_now']['slug'] = $row->slug;
        $data['video_now']['last_id_learn'] = $last_id_larn;
        $data['video_now']['is_premium'] = (int)$row->getClass->premium;
        // dd($data);
        $data_certificate = Certificate::where('user_id', auth()->user()->id)
                            ->where('class_id', $class_id)->latest();

        // if($data_certificate->class_id == $class_id)

        $data['video_now']['print_certificate'] = '/certificate_print/'.auth()->user()->id.'/'.$class_id;
        if($row->id == $m_id){
            $data['video_now']['badge'] = '  <i class="fa fa-check-circle text-success"></i> selesai';
        }else{
            $data['video_now']['badge'] = '';
            $data['video_now']['print_certificate'] = '';
        }
        $data['video_now']['image'] = 'https://i2.ytimg.com/vi/'.$row->slug.'/mqdefault.jpg';
        // $data['video_now']['image'] = asset('/assets/images/courses/courses-details.jpg');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?id='.$row->slug.'&part=contentDetails&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        $timer =  $result['items'][0]['contentDetails']['duration'];

        $log = ClassHistory::where('member_id', auth()->user()->id)->where('materi_id', $row->id)
        ->where('class_id', $row->class_id)->first();

        if($log !=  null){
            $data['video_now']['time'] = null;
        }else{
            // $duration = self::isoSeconds($data['time']);
            $data['video_now']['time'] = LearningController::isoSeconds($timer);
        }

        return $data;
    }

    public static function tools($class_id){
        $data = array();
        $tools = ClassMenu::where('class_id', $class_id)->where('premium', true)->value('tools_id');
        $arr_tools = explode(',', $tools);
        $data_tools = ToolsMateri::whereIn('id', $arr_tools)->get();

        foreach ($data_tools as $k => $v) {
            $data['data'][$k]['id'] = $v->id;
            $data['data'][$k]['title'] = $v->title;
            $data['data'][$k]['url'] = $v->link;
            $data['data'][$k]['image'] = '/backend/image/tools-materi/'.$v->image;
        }

        $data['source'] = ClassMenu::where('class_id', $class_id)->where('premium', true)->value('source_url');
        if($data['source'] == null){
            $data['source'] = '#';
        }

        // dd($data);

        return $data;
    }

    public static function dataProfile($id_user){
        $data = array();

        // if($id_user == auth()->user()->id){
            $id = $id_user;
        // }else{
        //     return redirect('/');
        // }

        // dd($id_user);

        $row  = ClassRequest::where('member_id', $id)->first();
        $log = ClassHistory::where('member_id', $id)->first();
        if(empty($row)){

            $data['class_total']  = 0;
            $data['class_finish'] = 0;
            $data['materi_total'] = 0;
            $data['materi_finish'] = 0;
        }else{
            $data['class_total']  = ClassRequest::where('member_id', $id)->where('premium', true)->pluck('class_id')->count();
            $data['class_finish'] = ClassHistory::where('member_id', $id)->where('premium', true)->select('class_id', DB::raw('count(*) as f_total'))->groupBy('class_id')->get()->count();
            $data['materi_total'] = view_stream::where('class_id', $row->class_id)->get()->count();
            $data['materi_finish'] = ClassHistory::where('member_id', $id)->where('premium', true)->select('materi_id', DB::raw('count(*) as m_total'))->groupBy('materi_id')->get()->count();
        }

        // dd($data);
        return $data;
    }

    public static function AppName(){
        $data = array();
        $app = ProfileGacademy::where('id', 1)->where('status', 'p')->first();
        $review = ReviewClassModel::avg('rating');
        $total_review = ReviewClassModel::count();
        $data['app'] = [
            'id' => $app->id,
            'name' => $app->name,
            'email' => $app->email,
            'phone' => $app->hp,
            'url' => $app->link,
            'address' => $app->address,
            'logo' => '/home-images/app/'.$app->logo,
            'total_class' => ClassMenu::where('status', 'p')->get()->count(),
            'star' =>round($review),
            'total_review' => $total_review,
        ];

        // dd($data);
        return $data;
    }

    public static function review($id, $limit){
        $data = array();
        if($id == null){
            $row_review_class   = ReviewClassModel::where('status', 'p')
                                    ->orderBy('updated_at', 'desc')->limit($limit)->get();

        }else{
            $row_review_class   = ReviewClassModel::where('class_id', $id)
                                    ->where('status', 'p')
                                    ->orderBy('updated_at', 'desc')->limit($limit)->get();

            $review_class       = ReviewClassModel::where('class_id', $id)->get();
            $rating             = $review_class->avg('rating');
            if($rating == 0){
                $rating = 5;
            }
            $count_review       = $review_class->count();
            $data = [
                'rating' => number_format($rating, 1, '.', ''),
                'count_review' => $count_review,
            ];

            $rate_stat = ReviewClassModel::where('class_id', $id)
                        ->select('rating', DB::raw("count(*) *100 / (select count(*) from review_class_models) as rate"))
                        ->orderBy('rating', 'desc')
                        ->groupBy('rating')
                        ->get();

            foreach ($rate_stat as $k => $v) {
                $data['rate_chart'][$k]['rating'] = $v->rating;
                $data['rate_chart'][$k]['rate'] = $v->rate;
            }
        }

        // dd($row_review_class);
        if(isset($row_review_class)){
            foreach ($row_review_class as $k => $v) {
                $data['comment'][$k]['text'] = ucfirst($v->review);
                if(isset($v->getUser)){
                    $data['comment'][$k]['name'] = ucwords($v->getUser->name);

                    if($v->getUser->photo != null ||is_file(public_path('/img/user/avatar/'.$v->getUser->photo))){
                        $photo  = '/img/user/avatar/'.$v->getUser->photo;
                    }else{
                        $photo  = '/img/user/s7.png';
                    }
                    $data['comment'][$k]['photo'] = $photo;
                    $data['comment'][$k]['role'] = ucwords($v->getUser->role);
                    $data['comment'][$k]['rating'] = $v->rating;
                }
                $data['comment'][$k]['class_name'] = strtoupper($v->getClass->name);
            }
        }

        return $data;
    }

    public static function userDetail($slug){

        $row = User::where('name', $slug)->first();
        $data['name'] = ucwords($row->name);
        $data['phone'] = self::phoneNumberConvert($row->phone ? $row->phone : '0');
        $data['email'] = $row->email;
        $data['address'] = $row->address;
        // dd($data);
        if($row->userData == null){
            $data['education'] = "";
            $data['bio'] = 'Lorem Ipsum has been the industr standard dummy text ever since unknown printer took galley type and scmbled make type specimen book. It has survived not only five centuries.';
        }else{
            $data['education'] = $row->userData->education;
            $data['bio'] = $row->userData->bio;

        }

        if($row->photo == null){
            $photo  = '/img/user/s7.png';
        }else{
            $photo  = '/img/user/avatar/'.$row->photo;
        }

        $data['photo'] = $photo;
        $data['url'] = '/learning/mentor/'.$row->name;


        // totalClassUSer
        $data['total_class'] = ClassMenu::where('add_by', $row->id)->count();
        $data['class_list']  = self::classList($row->id, null);
        // dd($data);
        $skill = SkillModel::where('user_id', $row->id)->first();
        if(empty($skill)){
            $data['skill_list'] = null;
        }else{
            $data['skill_list'] = json_decode($skill->skill);
        }

        // dd($data);
        return $data;
    }

    public static function users($role, $limit){
        $data = array();

        if(empty($role)){
            $rows = User::where('status', 'teacher')->orWhere('role', 'member')->orWhere('role', 'admin');
        }else{
            $rows = User::where('role', $role);
        }
                // ->where('email_verified_at', '!=', null)
        $rows = $rows->orderBy('created_at', 'desc')->paginate($limit);;

        $page = $rows;
        foreach ($rows as $k => $v) {
            $data[$k]['name'] = ucwords($v->name);

            if($v->userData == null){
                $data[$k]['education'] = "";
            }else{
                $data[$k]['education'] = $v->userData->education;
            }

            if($v->photo == null){
                $photo  = '/img/user/s7.png';
            }else{
                $photo  = '/img/user/avatar/'.$v->photo;
            }

            $data[$k]['photo'] = $photo;
            $data[$k]['url'] = '/mentor/'.$v->name;
        }

        // dd($data);
        return ['data'=>$data, 'page'=>$page];
    }

        public static function metaData($title, $keyword, $desc, $image, $url){
        $data = array();
        $data['title']      = ucwords($title);
        $data['keywords']   = $keyword;
        $data['desc']       = $desc;
        $data['image']      = $image;
        $data['m_url']      = config('app.url').'/'.$url;

        return $data;
    }

    public static function LastLearn($user_id){
        $data       = array();

        $row        = ClassHistory::where('member_id', $user_id);
        $last       = $row->max('id');

        $new        = ClassHistory::where('member_id', $user_id)->where('id', $last)->first(); //this last learn

        if(isset($new->id)){
            $data['id'] = $new->id;
            $data['title'] = ucwords($new->getMateri->judul);
            $data['class_name'] = strtoupper($new->getClass->name);
            $data['url'] = '/learning/content/'.$new->getMateri->slug;
            $data['image'] = 'https://i2.ytimg.com/vi/'.$new->getMateri->slug.'/mqdefault.jpg';

        }

        return $data;
    }

    public static function LearnHistory($user_id){
        $data       = array();
        $row        = ClassHistory::where('member_id', $user_id);
        $rows       = $row->orderBy('created_at', 'desc')->paginate(5);
        $last       = $row->max('id');

        $last_learn = self::LastLearn($user_id);

        // dd($last);
        $page = $rows;
        if(isset($rows->getClass)){
            foreach ($rows as $k => $v) {
                if($v->id != $last){ //cut last row
                    $data['data'][$k]['id'] = $v->id;
                    $data['data'][$k]['title'] = ucwords($v->getMateri->judul);
                    $data['data'][$k]['class_name'] = strtoupper($v->getClass->name);
                    $data['data'][$k]['url'] = '/learning/content/'.$v->getMateri->slug;
                    $data['data'][$k]['image'] = 'https://i2.ytimg.com/vi/'.$v->getMateri->slug.'/mqdefault.jpg';
                }
            }
        }

        return [
            'page' => $page ? $page : null,
            'data' => $data ? $data : null,
            'last_learn' => $last_learn ? $last_learn : null,
        ];
    }

    public static function GenerateCertificate($user_id, $class_id){
        $check = Certificate::where('class_id', $class_id)
                ->where('user_id', $user_id)
                ->where('status', 'p')
                ->first();

        if($check){
            $row        = User::where('id', $user_id)->first();
            $row_class  = ClassMenu::where('class_id', $class_id)->first();

            $nama = $row->name;
            $date = $check->created_at;
            $class_name = strtoupper($check->getClass->name);
            $code = '#'.$check->code;

            if (empty($nama)) {
                $gambar = "/img/certificate/1.jpg";
            }else {
                $gambar = realpath("img/certificate/certificate.png");
            }
            $image = imagecreatefrompng($gambar);
            $white = imageColorAllocate($image, 255, 255, 255);
            $black = imageColorAllocate($image, 0, 0, 0);
            $black = imageColorAllocate($image, 55, 55, 55);
            $font = "img/certificate/QuinchoScript_PersonalUse.ttf";
            $font_desc = "img/certificate/Inter-Medium.ttf";
            $size = 150;

            //definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
            $image_width = imagesx($image);

            //membuat textbox agar text centered
            $text_box = imagettfbbox($size,0,$font,$nama);
            $text_width = $text_box[2]-$text_box[0]; // lower right corner - lower left corner
            $text_height = $text_box[3]-$text_box[1];
            $x = ($image_width/2) - ($text_width/2);

            $text_box3 = imagettfbbox(55,0,$font,$class_name);
            $text_width3 = $text_box3[2]-$text_box3[0]; // lower right corner - lower left corner
            $text_height3 = $text_box3[3]-$text_box3[1];
            $x3 = ($image_width/2) - ($text_width3/2);

            //generate sertifikat beserta namanya
            imagettftext($image, $size, 0, $x, 1500, $black, $font, $nama);
            imagettftext($image, 60, 0, $x3, 1950, $black, $font_desc, $class_name);
            imagettftext($image, 40, 0, 190, 150, $black, $font_desc, $code);

            $save = "img/certificate/".$row->name."-".$row->id."-".$check->code.".png";
            header('Content-type: image/png');
            imagepng($image, $save);
            imagedestroy($image);
            return redirect('/certificate_print/'.$user_id.'/'.$class_id);

        }else{
            dd('not found');
        }

    }

    public static function CertificateData($limit){
        $data = array();
        $rows = Certificate::where('user_id', auth()->user()->id)
                ->where('status', 'p')
                ->orderBy('created_at', 'desc')
                ->paginate($limit);
        // dd($rows);

            foreach ($rows as $k => $v) {
                $data['data'][$k]['class'] = strtoupper($v->getClass->name);
                $data['data'][$k]['code'] = $v->code;
                $data['data'][$k]['url'] = '/certificate/'.$v->user_id.'/'.$v->class_id;
                $data['data'][$k]['url_download'] = '/img/certificate/class/'.$v->getUser->name.'-'.$v->user_id.'-'.$v->code.".png";
                if(empty($v->getClass->image)){
                    $image = '/home-images/kelas/thumbnail/default.jpg';
                }else{
                    $image = '/home-images/kelas/thumbnail/'.$v->getClass->image;
                }
                $data['data'][$k]['image'] = $image;
            }
        // dd($data);
        return $data;
    }



    public static function ClassHome($is_premium, $limit){
        $data = array();

        $class = ClassMenu::where('status', 'p');

        if($is_premium == true){
            $class = $class->where('premium', true);
        }else{
            $class = $class->where('premium', false);
        }

        $class = $class->orderBy('created_at','desc')->paginate($limit);

        foreach ($class as $k => $v) {
            $data['class'][$k]['id']                = $v->class_id;
            $data['class'][$k]['category_title']    = isset($v->getCategory) ? $v->getCategory->title : '';
            $data['class'][$k]['category_slug']     = isset($v->getCategory) ? $v->getCategory->slug : '';
            $data['class'][$k]['name']              = $v->name;
            $data['class'][$k]['image']             = asset('/home-images/kelas/thumbnail').'/'.$v->image;

            if($v->price == 0){
                $data['class'][$k]['price']         = 'GRATIS';
            }else{
                $data['class'][$k]['price']         = 'Rp '.number_format($v->price,0,',','.');
            }

            $data['class'][$k]['total_discount']    = $v->discount;
            $data['class'][$k]['discount']          = isset($v->discount) ? ('Rp '.number_format(($v->price - ($v->discount/100*$v->price)),0,',','.')) : '0';
            $data['class'][$k]['mentor']            = $v->getUser->name;
            $data['class'][$k]['url']               = '/class/'.strtolower(str_replace(' ', '-', $v->name));
            $data['class'][$k]['premium']           = $v->premium;
            $data['class'][$k]['author']            = $v->getUser->name;

            if(is_file(public_path('/img/user/avatar/'.$v->getUser->photo))){
                $data['class'][$k]['author_image']  = '/img/user/avatar/'.$v->getUser->photo;
            }else{
                $data['class'][$k]['author_image']  = '/img/user/s7.png';
            }

            $data['class'][$k]['author_url']        = '/mentor/'.$v->getUser->name;
            $data['class'][$k]['total_materi']      = view_stream::where('class_id', $v->class_id)->count();

            $row_review_class   = ReviewClassModel::where('class_id', $v->class_id);
            $review_class       = ReviewClassModel::where('class_id', $v->class_id)->get();
            $rating             = $review_class->avg('rating');
            if($rating == null){
                $rating = 5;
            }
            $count_review               = $review_class->count();
            $data['class'][$k]['star']  = number_format($rating, 1, '.', '');

            $data['review'] = [
                'rating'        => $rating,
                'count_review'  => $count_review,
            ];

        }
        // dd($data);
        $data['page'] = $class;

        return $data;
    }

    public static function phoneNumberConvert($nohp){

        $nohp = str_replace(" ","",$nohp);
        $nohp = str_replace("(","",$nohp);
        $nohp = str_replace(")","",$nohp);
        $nohp = str_replace(".","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 3)=='+62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '+62'.substr(trim($nohp), 1);
            }
        }

        return $hp;
    }

    public static function announcementDetail($slug){
        $data['meta']           = DetailController::metaData("Pengumuman", null, null, null, null);
        $data['data']           = Advertisement::AdvText();
        $data['row']            = PagesModel::where('slug', $slug)->first();
        $data['cart_count']     = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();

        return view('member.announcement', [
            'data' => $data,
        ]);
    }

    public static function Categories($limit){
        $data_category              = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->limit($limit)->get();
            foreach ($data_category as $k => $v) {
                $data[$k]['title']      = $v->title;
                $data[$k]['slug']       = $v->slug;
                $data[$k]['count']      = ClassMenu::where('category_id', $v->id)->count();
            }
        return $data;
    }

    public static function CartData(){
        $rows = Cart::where('user_id', auth()->user()->id)->where('status', 1)->get();
        $data['price_total'] = 0;

        if(isset($rows)){
            foreach($rows as $k=>$v){
                $data['data'][$k]['class_id']           = $v->class_id;
                $data['data'][$k]['data_class']         = self::classDetail($v->class_id);

                $data['data'][$k]['total_discount']     = $v->getClass->discount;
                $data['data'][$k]['price']              = $v->price;

                $data['price_total']                    += $v->price;
            }
        }
        // dd($data);
        return $data;

    }

    public static function event(){
        $data = array();
        $data['rows'] = Event::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        foreach ($data['rows'] as $k => $v) {
            $data['data'][$k]['id'] = $v->id;
            $data['data'][$k]['title'] = $v->title;
            $data['data'][$k]['category'] = $v->category_id ? $v->getCategory->title : 'Other';
            $data['data'][$k]['image'] = 'events-images/'.$v->image;
            $data['data'][$k]['url_meet'] = $v->url_meet;
            $data['data'][$k]['participant'] = $v->participant;
            $data['data'][$k]['participant_visit'] = EventRegisted::where('event_id', $v->id)->count();
            $data['data'][$k]['premium'] = $v->premium;
            $data['data'][$k]['price'] = $v->price;
            $data['data'][$k]['status'] = $v->status;
            $data['data'][$k]['created_by'] = $v->getUser->name;
            if(is_file(public_path('/img/user/avatar/'.$v->getUser->photo))){
                $data['data'][$k]['author_image']  = '/img/user/avatar/'.$v->getUser->photo;
            }else{
                $data['data'][$k]['author_image']  = '/img/user/s7.png';
            }
            $data['data'][$k]['url_author'] = '/mentor/'.$v->getUser->name;
            $data['data'][$k]['date'] = Carbon::parse($v->time)->isoFormat('dddd, DD MMMM Y');
            $data['data'][$k]['time'] = Carbon::parse($v->time)->Format('H:i').' WIB';
        }

        return $data;
    }

}
