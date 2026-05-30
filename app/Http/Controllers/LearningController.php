<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Models\User;
use App\chanel;
use App\Models\ClassHistory;
use App\Models\ClassRequest;
use App\Models\Order;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Creation;
use App\Models\Certificate;
use App\Models\ClassCategory;
use App\Models\PagesModel;
use App\Models\Level;
use App\Models\ClassMenu;
use App\Models\ReviewClassModel;
use App\Models\ToolsMateri;
use App\Models\UserData;
use App\ResizeImage;
use App\Services\Midtrans\CreateSnapTokenService;
use App\view_stream;
use App\Ua\MobileDetect;
use App\Ua\ImageManipulator;
use Carbon\CarbonInterval;
use DateInterval;
use DateTime;
use DB;
use File;
use Midtrans\Snap;
use PDF;

class LearningController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function profileMenu($slug)
    {
        $data = array();
        $row = User::where('id', auth()->user()->id)->first();
        $data['profile']            = self::profile();
        $data['data']               = DetailController::dataProfile($row->id);
        $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();
        $data['cart_data']          = DetailController::CartData();

        $data['url_overview']       = '/learning/profile/'.$row->name;
        $data['url_history']        = '/learning/tab-menu/history';
        $data['url_edit']           = '/learning/tab-menu/edit-profile';
        $data['url_payment']        = '/learning/tab-menu/payment';
        $data['url_certificate']    = '/learning/tab-menu/certificate';
        $data['url_report']         = '/learning/tab-menu/report';
        $data['url_creation']       = '/learning/tab-menu/creation';
        $data['url_cart']           = '/learning/tab-menu/cart';


        switch($slug){
            case 'creation' :
                $data['is_active']      = 'creation';
                $data['url_edit']       = '/learning/tab-menu/creation';
                $data['id']             = $row->id;
                $data['creation']           = 'active';
                $data['row']            = Creation::where('created_by', auth()->user()->id)->orderByDesc('created_at')->paginate(5);
            break;
            case 'edit-profile' :
                $data['is_active']      = 'edit';
                $data['url_edit']       = '/learning/tab-menu/edit-profile';
                $data['id']             = $row->id;
                $data['name']           = $row->name;
                $data['phone']          = $row->phone;
                if(empty($row->userData->education)){
                    $data['education']      = '';
                }else{
                    // $data['bio']            = $row->userData->bio;
                    $data['education']      = $row->userData->education;

                }
                $data['address']        = $row->address;
                $data['image']          = '/public/img/user/avatar/'.$row->photo;
                $data['edit']           = 'active';
            break;
            case 'report' :
                $data['is_active']      = 'report';
                $data['url_report']     = '/learning/tab-menu/'.$slug;
                $data['report']         ='active';
            break;
            case 'payment' :
                $data['is_active']      = 'payment';
                $data['url_payment']    = '/learning/tab-menu/'.$slug;
                $data['payment']        ='payment';
                $data['pay_data']       = DetailController::classRequest($row->id);
            break;
            case 'certificate' :
                $data['is_active']              = 'certificate';
                $data['url_certificate']        = '/learning/tab-menu/'.$slug;
                $data['certificate']            ='certificate';
                $data['data_certificate']       = DetailController::CertificateData(8);
            break;
            case 'history' :
                $data['is_active']              = 'history';
                $data['url_history']            = '/learning/tab-menu/'.$slug;
                $data['payment']                = $slug;
                $data['learn_history']          = DetailController::LearnHistory($row->id)['data'];
                $data['page']                   = DetailController::LearnHistory($row->id)['page'];
                $data['new_data']               = DetailController::LearnHistory($row->id)['last_learn'];
                // dd($data);
                return view('member.dashboard.log_story', compact('data'));
            break;
            case 'cart' :
                $data['is_active']      = 'cart';
                $data['url_cart']       = '/learning/tab-menu/'.$slug;
                $data['cart']           ='active';
            break;
            default :
                $data['data']           = DetailController::dataProfile($row->id);
        }
        // dd($data);
        return view('member.profile.index', compact('data'));

    }

    // DETAIL CONTENT LEARN
    public function contentLearn($slug){
        $row = view_stream::where('slug', $slug)->first();

        $data['profile']        = self::profile();
        $data['learn']          = DetailController::classDetail($row->class_id);
        $data['contents']       = DetailController::Contents($row->class_id, $row->slug);
        $data['tools']          = DetailController::tools($row->class_id);
        $data['profile']        = self::profile();


        // dd($data);
        return view('member.class.learn', compact('data'));
    }

    // DETAIL CONTENT CLASS PAGE
    public function classLearn($slug){
        $data['profile']        = self::profile();

        $class_id               = ClassMenu::where('slug', $slug)->value('class_id');
        $data['learn']          = DetailController::classDetail($class_id);
        $data['contents']       = DetailController::Contents($class_id, null);
        $data['tools']          = DetailController::tools($class_id);

        // dd($data);

        // YOUTUBE API 3
        $datayt = array();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?id='.$data['contents']['video_now']['slug'].'&part=contentDetails&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        $datayt['duration'] = $result['items'][0]['contentDetails']['duration'];
        // $datayt['duration'] = $data['contents']['video_now']['time'];

        return view('member.class.learn', compact('data'));
    }

    public function dashboard($id){
        $data = array();
        $data['profile']        = self::profile();
        $data['class']          = DetailController::classRequest($id);
        $data['url_history']    = '/learning/tab-menu/history';
        $data['announcement']    = PagesModel::where('category_id', 1)->where('status', 3)->latest()->first();

        // dd($data);

        return view('member.dashboard.index', compact('data'));
    }

    public function setting($id){
        $data = array();
        $data['profile']        = self::profile();
        $data['channel_check']  = self::channelCek();

        // $data['class']          = DetailController::classRequest($id);

        // dd($data);

        return view('member.dashboard.setting', compact('data'));
    }

    // PAYMENT
    public function payment(Request $request){
        $data = array();
        $class = ClassMenu::where('class_id', $request->class_id)->where('status', 'p')->first();
        $time = Carbon::now();
        $t = str_replace(':', '-', $time->toTimeString());

        $validasi = [
            'pay' => 'mimes:jpeg,png|max:5000|required',
        ];

        $msg = [
            'pay.mimes' => 'format gambar harus jpg atau png',
        ];

        $this->validate($request, $validasi, $msg);

        $photo = str_replace(' ', '-', auth()->user()->name)."-payment-".$t."-".$request->pay->getClientOriginalname();
        $save = $request->file('pay')->move('home-images/pay_image/',$photo);

        $pay = ClassRequest::where('member_id', auth()->user()->id)->where('class_id', $request->class_id)->update([
            'pay_image' => $photo,
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);

        $pay_img = ClassRequest::where('member_id', auth()->user()->id)->where('class_id', $request->class_id)->first();
        // dd($pay_img);
        if(empty($pay_img) && empty($pay_img->pay_img)){
            $image = '/home-images/pay_image/default.jpg';
        }else{
            $image = '/home-images/pay_image/'.$pay_img->pay_image;
        }

        $data = [
            'status' => 'pay',
            'email' => $class->getUser->email,
            'subject_email' =>  'Halo saya '.auth()->user()->name.' mulai berlangganan kelas '.ucwords($class->name).' melalui website G-Academy',
            'url_wa' => str_replace(' ', '%20', 'https://wa.me/'.$class->getUser->phone.'?text=Halo saya '.auth()->user()->name.' mulai berlangganan kelas '.ucwords($class->name).' melalui website G-Academy.'),
            'msg' => 'ON PROCESS',
            'class_name' => ucwords($class->name),
            'class_id' => $class->class_id,
            'image' => $image,
        ];
        $profile = self::profile();
        $channel_cek = self::channelCek();
        return view('member.validasi', compact('channel_cek', 'profile', 'data'));
    }

    public function payPage($cid, $uid){
        $data_class = ClassMenu::where('class_id', $cid)->first();
        $user       = User::where('id', auth()->user()->id)->first();

        $midtrans = new CreateSnapTokenService($user, $data_class);
        $snapToken = $midtrans->getSnapToken();

        $order = new Order();
        $order->number = $data_class->class_id;
        $order->total_price = $data_class->discount ? $data_class->price - ($data_class->discount/100*$data_class->price) : $data_class->price;
        $order->snap_token = $snapToken;
        $order->save();
        // dd($order);
        return view('member.orders.show', compact('snapToken', 'data_class'));
    }


    // START PREMIUM CONTENT
    public function startPremiumClass(Request $request){
        // dd($request);
        $user       = User::where('id', auth()->user()->id)->first();
        $data_class = ClassMenu::where('class_id', $request->class_id)->first();

        $snapToken = $request->snap_token;
        // dd($snapToken);
        if (empty($snap_token)) {

            // Jika snap token masih NULL, buat token snap dan simpan ke database
            $midtrans = new CreateSnapTokenService($user, $data_class);
            $snapToken = $midtrans->getSnapToken();

            $order = new Order();
            $order->number = $data_class->class_id;
            $order->total_price = $data_class->discount ? $data_class->price - ($data_class->discount/100*$data_class->price) : $data_class->price;
            $order->snap_token = $snapToken;
            $order->save();
        }

            $validasi1 = ClassRequest::where('class_id', $data_class->class_id)->where('member_id', $user->id)
            ->where('premium', true)->first();
            $validasi2 = ClassRequest::where('class_id', $data_class->class_id)->where('member_id', $user->id)->first();

            $alert = 'alertPay';

            if(!empty($validasi1)){
                return redirect('/learning/class_list')->with('msg', 'kelas sudah diambil');
            }else if(!empty($validasi2)){
                return redirect('/learning/pay_status/'.$data_class->class_id.'')->with('msg-notpay', '');
            }else{
                // dd('data blm ada');
                $validate = new ClassRequest;
                $validate->member_id    = $user->id;
                $validate->class_id     = $data_class->class_id;
                $validate->pay_image    = null;
                $validate->status       = 'p';
                $validate->premium      = false;
                $validate->save();
            }

        return view('member.orders.show', compact('snapToken', 'data_class'));

    }

    // PREMIUM CONTENT
    public function channelPremium($id){
        $channel = chanel::where('id', $id)->first();
        $data = array();
        $data = [
            'menu' => 'premium'
    ];

        $history = ClassHistory::where('member_id', auth()->user()->id)->first();
        // dd($history);
        if($history != null){
            $materi = view_stream::where('chanel_id', $id)->where('status', 'p')->where('premium', true)->paginate(8);

            // dd($materi);
        }else{
           return redirect('/learning/channel_detail/'.$id.'')->with('msg', 'Silakan berlangganan untuk mendaptakan konten premium');
        }


        $profile = self::profile();
        $channel_cek = self::channelCek();
        return view('member.channel_detail', compact('data', 'materi', 'channel_cek', 'profile', 'channel'));
    }

    // LAST WATCH HISTORY PREMIUM CONTENT
    public function lastHistoryPremium($id){
        $history = ClassHistory::where('member_id', auth()->user()->id)->where('class_id', $id)->latest()->first();
        // dd($history);
        if(empty($history)){
            return redirect('/learning/class_detail/premium/'.$id);

        }
        return redirect('/learning/materi_detail/'.$history->materi_id);
    }

    // CHANNEL DETAIL FOR MEMBER
    public function channelDetail($id){
        $channel = chanel::where('id', $id)->first();
        $materi = view_stream::where('chanel_id', $id)->where('status', 'p')->where('premium', false)->paginate(8);
        // dd($materi);
        $data = array();
        $data = [
            'menu' => 'video'
        ];
        $profile = self::profile();
        $channel_cek = self::channelCek();
        return view('member.channel_detail', compact('data', 'materi', 'channel_cek', 'profile', 'channel'));
    }

    // LIST CLASS
    public function listClassHome(){
        $data = array();

        $class = ClassMenu::where('status', 'p')->where('premium', true)->orderBy('created_at','desc')->paginate(8);
        // dd($class);
        foreach ($class as $k => $v) {
            $data['class'][$k]['id'] = $v->class_id;
            $data['class'][$k]['category_title']    = isset($v->getCategory) ? $v->getCategory->title : '';
            $data['class'][$k]['category_slug']     = isset($v->getCategory) ? $v->getCategory->slug : '';
            $data['class'][$k]['name'] = $v->name;
            $data['class'][$k]['image'] = asset('/home-images/kelas/thumbnail').'/'.$v->image;

            if($v->price == 0){
                $data['class'][$k]['price'] = 'GRATIS';
            }else{
                $data['class'][$k]['price'] = 'Rp '.number_format($v->price,0,',','.');
            }

            $data['class'][$k]['total_discount']    = $v->discount;
            $data['class'][$k]['discount']          = isset($v->discount) ? ('Rp '.number_format(($v->price - ($v->discount/100*$v->price)),0,',','.')) : '0';
            $data['class'][$k]['price_default']     = isset($v->discount) ? ($v->price - $v->discount/100*$v->price) : $v->price;
            $data['class'][$k]['mentor']            = $v->getUser->name;
            $data['class'][$k]['url']               = '/class/'.$v->slug;;
            $data['class'][$k]['premium']           = $v->premium;
            $data['class'][$k]['author']            = $v->getUser->name;

            if(is_file(public_path('/img/user/avatar/'.$v->getUser->photo))){
                $data['class'][$k]['author_image'] = 'public/img/user/avatar/'.$v->getUser->photo;
            }else{
                $data['class'][$k]['author_image'] = 'public/img/user/s7.png';
            }

            $data['class'][$k]['author_url']        = '/mentor/'.$v->getUSer->name;
            $data['class'][$k]['total_materi']      = view_stream::where('class_id', $v->class_id)->count();

            $row_review_class   = ReviewClassModel::where('class_id', $v->class_id);
            $review_class       = ReviewClassModel::where('class_id', $v->class_id)->get();
            $rating             = $review_class->avg('rating');
            if($rating == null){
                $rating = 5;
            }
            $count_review       = $review_class->count();
            $data['class'][$k]['star'] = number_format($rating, 1, '.', '');

            $data['review'] = [
                'rating' => $rating,
                'count_review' => $count_review,
            ];

        }
        $data['page'] = $class;

        // META DATA
        $data['meta']           = DetailController::metaData("Semua Kelas", "kelas, free, premium", "Pilihan kelas terbaik dan diunggulkan untuk member g-academy", null, null);
        $data['profile']        = self::profile();
        $data['data']           = Advertisement::AdvText();
        $data['categories']     = DetailController::Categories(6);
        $data['categories_sidebar'] = DetailController::Categories(20);
        $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();


        // dd($data['class']);
        return view('member.index', compact('data'));
    }

    // END MATERI
    public function materiEnd(Request $request){
        // dd($request);
        $user_id    = auth()->user()->id;
        $materi_id  = $request->materi_id;
        $class_id   = $request->class_id;
        $rating     = $request->selected_rating;
        $review     = $request->review_text;

        if(empty($rating)){
            $rating = 1;
        }

        $check_rate = ReviewClassModel::where('user_id', $user_id)
                        ->where('class_id', $class_id)->first();

        // save rating review
        if(isset($rating) && isset($review)){
            if(empty($check_rate)){
                $review_class = new ReviewClassModel();
                $review_class->class_id = $class_id;
                $review_class->user_id  = auth()->user()->id;
                $review_class->rating   = $rating;
                $review_class->review   = $review;
                $review_class->status   = 'p';
                $review_class->save();
            }else{
                return back()->with('alert', 'Anda sudah memberi review');
            }
        }

        $materi         = view_stream::where('id', $materi_id)->first();
        $total_materi   = view_stream::where('class_id', $class_id)->count();
        $materi_end     = ClassHistory::where('class_id', $class_id)->where('member_id', auth()->user()->id)->get()->count();
        $log            = ClassHistory::where('class_id', $class_id)->where('member_id', auth()->user()->id)->get()->count();
        // dd($materi_end);
        $date = Carbon::now('Asia/Jakarta');
        // dd($log);
        if(isset($materi)){
            if($log == $total_materi - 1){
                $class_history = new ClassHistory;
                $class_history->member_id = auth()->user()->id;
                $class_history->materi_id = $materi->id;
                $class_history->class_id = $materi->class_id;
                $class_history->status = 'p';
                $class_history->premium = $materi->premium;
                // $class_history->rating = (int)$rating;
                // $class_history->review = htmlentities($review, ENT_QUOTES);
                $class_history->created_at = $date;
                $class_history->save();

                $c = ($class_id*77)*$user_id;
                $code = 'G'.$c;

                if(isset($class_history)){
                    if($materi_end >= $total_materi-1){
                        $data['get_certificate'] = true;
                        $certificate = new Certificate();
                        $certificate->code = $code;
                        $certificate->user_id = auth()->user()->id;
                        $certificate->class_id = $class_id;
                        $certificate->status = 'p';
                        $certificate->save();
                    }
                }

                return back()->with('msg', 'Terimakasih telah menyelesaikan materi '.ucwords($materi->judul).'');
            }else{
                return back()->with('msg', 'Tidak dapat menyelesaikan materi, karena anda sudah menyelesiakan sebelumnya');

            }

        }
    }

    public function materiRating($mid, $cid){
        $user_id  = auth()->user()->id;
        $materi_id = $mid;
        $class_id = $cid;
        // dd($class_id);
        // $rating = $request->selected_rating;
        // $review = $request->review_text;


        $materi = view_stream::where('id', $materi_id)->first();
        $class = ClassMenu::where('class_id', $class_id)->first();
        $log = ClassHistory::where('class_id', $class_id)->where('member_id', auth()->user()->id)
                ->where('materi_id', $materi_id)->get()->count();
        // dd($log);
        $date = Carbon::now('Asia/Jakarta');
        $data = array();

        $data['user_id']        = $user_id;
        $data['class_id']       = $class_id;
        $data['materi_id']      = $materi_id;
        $data['materi_slug']    = $materi->slug;
        $data['class_slug']     = $class->slug;
        $data['title']          = $materi->judul;
        $data['class_name']     = ucwords($class->name);

        $data['meta']       = DetailController::metaData("Reveiw Kelas", null, null, null, null);
        $data['profile']    = self::profile();
        $data['data']       = Advertisement::AdvText();
        // dd($data);
        return view('member.class.review', compact('data'));

        // dd($kelas);

    }


    // LIST CLASSROOM
    public function classMenu(){
        $class = classMenu::where('status', 'p')->orderBy('created_at')->paginate(8);

        $profile = self::profile();
        $channel_cek = self::channelCek();
        return view('member.class_list', compact('class', 'channel_cek', 'profile'));
    }

    //// CLASS PREMIUM MENU
    public function classPremium($id){
        // $history = ClassHistory::where('member_id', auth()->user()->id)->first();
        $class = ClassMenu::where('class_id', $id)->first();
        $data = array();
        $langganan = '';
        $materi = '';
        $first = '';
        //cek apakah user usuah berlangganan kelas
        $req = ClassRequest::where('member_id', auth()->user()->id)->where('class_id', $id)->where('premium', true)->first();
        // jika request tidak kosong
        if($req != null){
            $materi = ClassHistory::where('class_id', $id)->where('member_id', auth()->user()->id)->where('status', 'p')
            ->where('premium', true)->orderBy('id', 'desc')->paginate(8);
            // dd($materi);
            if(empty($materi[0])){
                $first = view_stream::where('class_id', $id)->where('premium', true)->where('status', 'p')->first();
                // dd($first);
            }
        }else{
            // jika berlum berlangganan
            return redirect('/learning/class_detail/'.$id.'')->with('msg', 'Silakan berlangganan untuk mendaptakan konten premium');
        }
        // dd($materi);

        $data = [
            'menu' => 'premium',
            'materi' => $materi,
        ];
        // dd($data['first']['judul']);
        $profile = self::profile();
        $channel_cek = self::channelCek();
        return view('member.class_premium', compact('data', 'first', 'channel_cek', 'profile', 'class', 'req'));
    }



    public function mentorDetail($id){

    }

    // MY PROFILE
    public function myProfile($slug){

        $id_auth = auth()->user()->id;
        $user = User::where('name', $slug)->first();
        // dd($user);
        if($user == null && $user->id != $id_auth)
        {
            return redirect('/email/verify');
        }else{

            $data = array();
            $data['is_active']          = $slug;
            $data['overview']           = 'active';
            $data['url_overview']       = '/learning/profile/'.$user->name;
            $data['url_history']        = '/learning/tab-menu/history';
            $data['url_payment']        = '/learning/tab-menu/payment';
            $data['url_certificate']    = '/learning/tab-menu/certificate';
            $data['url_edit']           = '/learning/tab-menu/edit-profile';
            $data['url_creation']       = '/learning/tab-menu/creation';
            $data['url_report']         = '/learning/tab-menu/report';
            $data['url_cart']           = '/learning/tab-menu/cart';
            $data['profile']            = self::profile();
            $data['data']               = DetailController::dataProfile($user->id);
            $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();;
            
            // dd($data);

            return view('member.profile.index', compact('data'));
        }


    }

    // NEW PROFILE SETTING
    public function newProfileSetting(){
        $profile = self::profile();
        $channel_cek = self::channelCek();
        return view('member.new_data_profile', compact('profile', 'channel_cek'));
    }

    // NEW SETTING SAVE
    public function myProfileSetting($id){
        $user = User::where('id', $id)->where('status', 'active')->first();

        $profile = self::profile();
        $channel_cek = self::channelCek();
        return view('member.profile_setting', compact('profile', 'channel_cek', 'user'));
    }

    // MY PROFILE UPDATE
    public function newProfileSettingSave(Request $request){
        $validasi = [
            'photo' => 'required|max:5000',
            'phone' => 'required',
            'address' => 'required',
        ];
        $msg = [
            'photo.mimes' => 'format gambar harus jpg atau png',
        ];

        $this->validate($request, $validasi, $msg);
        if($request->photo != null){
            $photo = "view_stream-".$request->id."-".$request->photo->getClientOriginalname();
            $save = $request->file('photo')->move('img/user/',$photo);
            // dd($photo);
            $user = User::find($request->id)->update([
                'phone' => $request->phone,
                'photo' => $photo,
                'address' => $request->address,
            ]);
        }

        return redirect('/learning')->with('msg', 'Selamat data di G-Academy Learning, silakan pilih kelas dan materi yang tersedia');
    }

    // MY PROFILE UPDATE
    public function myProfileSettingUpdate(Request $request){
        $folder_first   = 'public/img/user/';
        $folder_second  = 'public/img/user/avatar/';

        $photo_old = User::where('id', auth()->user()->id)->value('photo');
        if(empty($request->photo)){
            $photo = $photo_old;
            $image_crop_name = $photo;
            // dd($photo);
        }else{
            $format = $request->photo->getClientOriginalExtension();
            if($format == 'png' || $format == 'jpg' || $format == 'jpeg'){
                if(is_file(public_path($folder_second.$photo_old))){
                    unlink(public_path($folder_second.$photo_old));
                    $photo = "view_stream-".$request->id."-".$request->photo->getClientOriginalname();
                    $save = $request->file('photo')->move($folder_first,$photo);
                    $image_crop_name = ResizeImage::resizeImage($photo, $request->username, $folder_first, $folder_second)['file_name'];

                }else{
                    $photo = "view_stream-".$request->id."-".$request->photo->getClientOriginalname();
                    $save = $request->file('photo')->move($folder_first,$photo);
                    $image_crop_name = ResizeImage::resizeImage($photo, $request->username, $folder_first, $folder_second)['file_name'];
                }
            }else{
                return back()->with('error', 'Format foto tidak didukung');
                // dd($format);
            }
        }


        $user = User::find($request->id)->update([
            'name' => $request->username,
            'phone' => $request->phone,
            'photo' => $image_crop_name,
            'address' => $request->address,
        ]);

        $user_data = UserData::where('user_id', $request->id)->first();
        if(empty($user_data)){
           $add_user_data = new UserData();
           $add_user_data->user_id = auth()->user()->id;
           $add_user_data->education = $request->education;
           $add_user_data->save();
        }else{
            UserData::where('user_id', auth()->user()->id)->update([
                'education' => $request->education,
            ]);
        }

        return redirect('/learning/tab-menu/edit-profile')->with('msg', 'Profile berhasil diupdate');
    }

    /*******************************************
         FUNCTION STATIC   G-ACADEMY LEARNING
    ********************************************/

    public static function channelCek(){
        $takes_controller = new DashboardController;
        $profile = $takes_controller->userData(auth()->user()->id);
        $c = $takes_controller->channelCek();
        return $c;
    }

    public static function profile(){
        $takes_controller = new DashboardController;
        $profile = $takes_controller->userData(auth()->user()->id);
        return $profile;
    }

    public static function sidebarRight($id, $premium){
        $data = array();
        $row = array();
        $cnow = Carbon::now();

        $history_cek = ClassHistory::where('class_id', $id)->where('member_id', auth()->user()->id)->first();
        $history_count = ClassHistory::where('class_id', $id)->where('member_id', auth()->user()->id)->orderBy('materi_id', 'asc')->get()->count();
        $history = ClassHistory::where('class_id', $id)->where('member_id', auth()->user()->id)->orderBy('materi_id', 'asc')->get();
        // dd($history_cek);
            foreach($history as $k => $v){
                // if(empty($history_count) && empty($history)){

                // }
                $row['materi_id'] = $v->materi_id;
            }
        if($history_cek == null){

            // dd($premium);
            $video = view_stream::where('class_id', $id)->where('premium', $premium)->where('status', 'p')->orderBy('id', 'asc')->get();
            $no = 1;
            foreach($video as $k =>$v){
                $data[$k]['no'] = $no;
                $data[$k]['id'] = $v->id;
                $data[$k]['title'] = $v->judul;
                $data[$k]['slug'] = $v->slug;
                $data[$k]['link'] = $v->link;
                $data[$k]['picture'] = $v->gambar;
                $data[$k]['view'] = $v->visitor;
                $data[$k]['premium'] = (int)$v->premium;
                $data[$k]['time'] = Carbon::parse($v->updated_at)->diffInDays($cnow);
                $data[$k]['disable'] = '';
                $data[$k]['background'] = '';
                $data[$k]['hidden'] = 'display:none';
                }
        }else{
            if(isset($history)){
                $video = view_stream::where('class_id', $id)->where('premium', $premium)->where('status', 'p')->orderBy('id', 'asc')->get();
                foreach($video as $k =>$v){
                    $data[$k]['id'] = $v->id;
                    $data[$k]['title'] = $v->judul;
                    $data[$k]['slug'] = $v->slug;
                    $data[$k]['link'] = $v->link;
                    $data[$k]['picture'] = $v->gambar;
                    $data[$k]['view'] = $v->visitor;
                    $data[$k]['premium'] = (int)$v->premium;
                    $data[$k]['time'] = Carbon::parse($v->updated_at)->diffInDays($cnow);
                    $data[$k]['hidden'] = '';
                    // dd($k);

                    if($data[$k]['id'] == $row['materi_id']){
                        $data[$k]['disable'] = '';
                        $data[$k]['background'] = '';
                        $data[$k]['success'] = '';
                    }else{
                        if($k > $history_count){
                            // if($k == $history_count){
                            //     $data[$k]['success'] = 'none;';
                            // }
                            $data[$k]['success'] = 'none;';
                            $data[$k]['background'] = 'background:#dddddd;';
                            $data[$k]['disable'] = 'pointer-events: none;';
                        }
                        // else if($k > $history_count - 1){
                        // }
                        else{
                            $data[$k]['disable'] = '';
                            $data[$k]['background'] = '';
                            $data[$k]['success'] = '';
                        }
                    }

                    // dd($data);
                }

            }
        }


        // dd($data);
        return $data;

    }

    // FORMAT DATE DURATION YT API
    public static function isoSeconds($value){
        $interval = new DateInterval($value);

        return ($interval->d * 24 * 60 * 60) +
            ($interval->h * 60 * 60) +
            ($interval->i * 60) +
            $interval->s;
    }

    // second to date
    public static function contentDate($time){
        $data = array();
        $t = $time;
        $date = CarbonInterval::seconds($t)->cascade();
        $d = $date->toArray();

        $data['data'] = $d['hours'].':'.$d['minutes'].':'.$d['seconds'];
        return $data;
    }

}
