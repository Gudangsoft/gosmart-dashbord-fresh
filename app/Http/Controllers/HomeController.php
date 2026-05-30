<?php

namespace App\Http\Controllers;

use App\Models\ClassCategory;
use App\Models\ClassHistory;
use App\Models\ClassMenu;
use App\Models\ClassRequest;
use App\Models\Cart;
use App\Models\Event;
use App\Models\EventRegisted;
use Illuminate\Http\Request;
use DB;
use App\view_stream;
use App\Models\PagesModel;
use App\Models\PaymentModel;
use App\Models\ProfileGacademy;
use App\Models\Creation;
use App\Ua\MobileDetect;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
        {
        //  $this->middleware(['auth']);
        }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
        $view_stream = DB::table('view_stream')->join('chanel','chanel.id','=','view_stream.chanel_id')->orderBy('created_at','desc')->paginate(12);
        $chanel = DB::table('chanel')->get();

        return view('view',compact('view_stream','chanel'));
        }

    public function home(){
        
        // $data = array();
        // $data['class']              = DetailController::ClassHome(false, 4);
        // $data['class_premium']      = DetailController::ClassHome(true, 4);
        // $data['categories']         = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        // $data['creations']          = Creation::inRandomOrder()->get();
        // $data['creations_count']    = Creation::all()->count();

        // $data['profile_app']        = DetailController::AppName();
        // $data['review']             = DetailController::review(null, 6);
        // $data['data']               = Advertisement::AdvText();
        // $data['partner']            = self::partner();
        // $data['meta']               = DetailController::metaData(null, null, null, null, null);
        // $data['statistics']         = self::statistics();
        // $data['user_join']          = User::count();
        // $data['row']                = PagesModel::where('status', 1)->latest('id')->first();
        // $data['categories_sidebar'] = DetailController::Categories(20);
        // $data['cart_count']         = isset(auth()->user()->id) ? Cart::where('user_id', auth()->user()->id)->where('status', 1)->count() : '';
        // $data['event']              = DetailController::event();
        // $data['announcement']       = PagesModel::where('type', 1)->where('status', 1)->latest()->first();

        // dd($data['announcement']);
        // return view('home', compact('data'));
        
        return redirect()->to('https://gosmart.id');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function livestream(){
        $data = array();
        $data['rows'] = DetailController::livestreamings(12)['rows'];
        foreach ($data['rows'] as $k => $v) {
            $data['live'][$k]['id'] = $v->id;
            $data['live'][$k]['title'] = $v->title;
            $data['live'][$k]['image'] = 'https://i2.ytimg.com/vi/'.$v->youtube_id.'/mqdefault.jpg';
            $data['live'][$k]['youtube_id'] = $v->youtube_id;
        }

        $data['meta']['title']  = 'Live Stream';
        // $data['profile']        = self::profile();
        $data['data']           = Advertisement::AdvText();
        $data['meta']           = DetailController::metaData("Live", "live", "Tonton video siaran langsung dari g-academy", null, null);
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        $data['cart_count']     = isset(auth()->user()->id) ? Cart::where('user_id', auth()->user()->id)->where('status', 1)->count() : null;

        return view('member.livestream.index', compact('data'));
    }

    public function event(){
        $data['event'] = DetailController::event();

        $data['meta']['title']  = 'Live Stream';
        $data['data']           = Advertisement::AdvText();
        $data['meta']           = DetailController::metaData("Event", "event", "Ikuti event dari g-academy dan dapatkan voucher dikson kelas premium", null, null);
        $data['cart_count']     = isset(auth()->user()->id) ? Cart::where('user_id', auth()->user()->id)->where('status', 1)->count() : null;
        // $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        // dd($data);

        return view('member.livestream.index', compact('data'));
    }

    public function eventRegisted($id){
        $data['row']            = Event::findOrFail($id);
        $data['payment']        = PaymentModel::where('user_id', 33)->latest()->first();
        $data['register']       = EventRegisted::where('event_id', $id)->count();

        $data['meta']['title']  = 'Event Registed';
        $data['data']           = Advertisement::AdvText();
        $data['meta']           = DetailController::metaData("Event Registed", "event-registed", "Ikuti event dari g-academy dan dapatkan voucher dikson kelas premium", null, null);
        $data['cart_count']     = isset(auth()->user()->id) ? Cart::where('user_id', auth()->user()->id)->where('status', 1)->count() : null;
        // dd($data);
        // dd($data['row']->end_time);
        if($data['register'] == $data['row']->participant || Carbon::now() > $data['row']->end_time){
            return view('member.livestream.form-event-close', [
                'data' => $data
            ]);

        }else{
            return view('member.livestream.form-event', [
                'data' => $data
            ]);

        }
    }

    public function mentor(){
        $data = array();

        $data['mentor'] = DetailController::users('teacher', 8)['data'];
        $data['page']   = DetailController::users('teacher', 8)['page'];


        $data['data']           = Advertisement::AdvText();
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        $data['meta']           = DetailController::metaData("Mentor", "mentor, guru, author", "Mentor pilihan g-academy dengan keahlian yang berkompeten dibidangnya", null, null);

        // dd($data);
        return view('member.mentor.index', compact('data'));
    }

    // CLASS DETAIL
    public function classDetail($slug){
        $data = array();
        $main_class = ClassMenu::where('slug', $slug)->first();
        $id = $main_class->class_id;
        $user_id = '';

        if($main_class->premium == true){
            $data['get_certificate'] = 'Ya';
        }else{
            $data['get_certificate'] = 'Tidak';
        }

        if(isset($main_class)){
            $counter = $main_class->visitor;
            $c = ClassMenu::where('slug', $slug)->update([
                'visitor' => $counter + 1,
            ]);
        }

        if(empty(auth()->user()->id)){
            $user_id = null;
        }else{
            $user_id = auth()->user()->id;
        }

        $req    = ClassRequest::where('member_id', $user_id)->where('class_id', $id)->first();

        if($main_class->premium == false){
            $data['main']['url'] = '/learning/class_learn/'.$main_class->slug;
            $class_cek = 0;
        }else{
            if(empty($req)){
                $class_cek = 1;
            }elseif($req->premium == true){
                $class_cek = 2;
                $data['main']['url'] = '/learning/class_learn/'.$req->getClass->slug;
            }elseif($req->premium == false){
                $class_cek = 3;
                $data['main']['url'] = '/learning/pay_status/'.$req->class_id;
            }
        }


        $materi = '';
        $materi = view_stream::where('class_id', $id)->where('status', 'p')->where('premium', false)->orderBy('id', 'asc')->paginate(8);
        $premium_cek = ClassHistory::where('member_id', $user_id)->where('class_id', $id)
                    ->where('premium', true)->get()->count();

        $data['detail'] = DetailController::classDetail($id);
        $data['main']['menu']   = 'video';
        $data['main']['premium_cek'] = $class_cek;


        // META DATA
        $data['meta']           = DetailController::metaData(
                                    $main_class->name,
                                    $main_class->name,
                                    htmlspecialchars_decode($main_class->description),
                                    config('app.url').''.$data['detail']['class']['image'],
                                    'class/'.$slug
                                );

        // dd($data);
        // $data['profile']        = self::profile();
        $data['data'] = Advertisement::AdvText();
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);

        if(empty(auth()->user()->id)){
            $data['username'] = null;
        }else{
            $data['cart_count']     = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();
            $data['username'] = auth()->user()->name;
        }

        return view('member.class.detail', compact('materi', 'data'));
    }

    public function TermsAndConditions(){
        $data['meta']           = DetailController::metaData("Syarat dan Ketentuan", null, null, null, null);
        $data['data']           = Advertisement::AdvText();
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);

        return view('terms', compact('data'));
    }

    public function contact(){
        $data['meta']           = DetailController::metaData("Kontak Kami", null, null, null, null);
        $data['data']           = Advertisement::AdvText();
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);

        return view('contact', compact('data'));
    }

    public function about(){
        $data['meta']           = DetailController::metaData("Tentang Kami", null, null, null, null);
        $data['data']           = Advertisement::AdvText();
        $data['about']           = self::profileApp();
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);

        return view('about', compact('data'));
    }

    public function partners(){
        $data['meta']           = DetailController::metaData("Partner Kami", null, null, null, null);
        $data['data']           = Advertisement::AdvText();
        $data['partners']       = self::partner();
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        // dd($data);

        return view('partner', compact('data'));
    }

    public static function partner(){
        $data_partner = 'public/backend/json/data_partner.json';
        $jsonfile = file_get_contents($data_partner);

        $data['main'] = json_decode($jsonfile, true);

        foreach ($data['main'] as $k=>$v) {
            $data['partner'][$k]['id'] = $v['id'];
            $data['partner'][$k]['title'] = $v['title'];
            $data['partner'][$k]['url'] = $v['url'];
            $data['partner'][$k]['status'] = $v['status'];
            $data['partner'][$k]['date'] = $v['created_at'];
            $data['partner'][$k]['path_image'] = $v['path_image'];
        }

        return $data;
    }

    public static function statistics(){
        $url = 'https://g-academy.net/api/statistics';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        return $response;

    }

    public static function profileApp(){
        $row = ProfileGacademy::first();

        $data['data'] = $row->about;
        $data['image'] = $row->logo;

        return $data;
    }

}
