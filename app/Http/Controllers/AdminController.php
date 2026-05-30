<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\DashboardController;
use DB;
use App\view_stream;
use App\chanel;
use App\Models\Category;
use App\User;
use App\Models\Level;
use App\Models\ClassMenu;
use App\Models\ClassHistory;
use App\Models\ClassRequest;
use App\Models\Certificate;
use App\Models\ChannelData;
use App\Models\PaymentModel;
use App\Models\ProfileGacademy;
use App\Models\SkillModel;
use App\Models\ToolsLinkage;
use App\Models\ToolsMateri;
use App\Models\UserData;
use App\Models\WithdrawModel;
use App\ResizeImage;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class AdminController extends Controller
{

    // hanya untuk admin
    public function __construct()
      {
          $this->middleware(['auth','admin']);
        //   $this->middleware(['auth','super_admin']);

        // bagaimana cara agar bisa memanggil dua middleware ?
      }

    public function index(){
        return redirect('/dashboard');
    }

    public function appName(Request $request){

        $image = $request->image;
        $gambar_old     = ProfileGacademy::where('id', $request->id)->value('logo');

        if(empty($image)){
            $gambarx = $gambar_old;
        }else{
            if(is_file(public_path('/home-images/app/'. $gambar_old))){
                unlink(public_path('/home-images/app/'. $gambar_old));
                $gambarx = "logo".auth()->user()->id.time().".".$request->image->getClientOriginalExtension();
                $save = $request->file('image')->move('home-images/app/',$gambarx);
            }else{
                $gambarx = "logo".auth()->user()->id.time().".".$request->image->getClientOriginalExtension();
                $save = $request->file('image')->move('home-images/app/',$gambarx);
            }
        }

        $input  = $request->except(['id', '_token', 'image']);
        $update = ProfileGacademy::findOrFail($request->id);
        $update->logo = $gambarx;
        $update->fill($input)->save();

        // ProfileGacademy::where('id', $id)->update([
        //     $request->except(['id', '_token', 'logo']),
        //     'logo' => $gambarx
        // ]);

        // ProfileGacademy::where('id', $id)->update([
        //     'name'      => $name,
        //     'email'     => $email,
        //     'hp'        => $phone,
        //     'logo'      => $gambarx,
        //     'add_by'    => auth()->user()->id,
        //     'status'    => 'p',
        //     'address'   => $address,
        // ]);

        return redirect('/dashboard/admin/setting')->with('appname', 'Setting Aplikasi Berhasil');
    }

    // PREMIUM CHANGE
    public function premiumChange($data, $id){
        $class_request =  ClassRequest::where('id', $id)->where('status', 'p')->first();
        if($data == 1){
            ClassRequest::where('id', $id)->update([
                'premium' => true,
                'updated_at' => Carbon::now(),
                'accepted_by' => auth()->user()->id,
            ]);

        }else if($data == 0){
            ClassRequest::where('id', $id)->update([
                'premium' => false,
                'updated_at' => Carbon::now(),
                'accepted_by' => auth()->user()->id,
            ]);

        }
        return redirect('/dashboard/confirmation_class')->with('sukses', 'Data berhasil diupdate');
      }

    // KONFIRMASI CLASS PREMIUM
    public function premiumConfirm(){
        $rows = ClassRequest::where('status', 'p')->orderBy('created_at', 'asc')->paginate(100);
        // $history = ClassHistory::where()
        // dd($rows);
        $channel_cek = self::channelCek();
        $profile = self::profile();
        return view('backend.premium_confirm', compact('rows', 'channel_cek', 'profile'));
    }

    //DATA MATERI
    public function materiData(){
        $channel_cek = self::channelCek();
        $profile = self::profile();

        $materi = DB::table('view_stream')->get();
        return view('backend.setting.data_materi', compact('profile', 'channel_cek', 'materi'));
    }

    public function view(){
        $takes_controller = new DashboardController;
        $profile = $takes_controller->userData(auth()->user()->id);
        $channel_cek = $takes_controller->channelCek();

        $data = array();
        $app = ProfileGacademy::where('status', 'p')->first();
        $data['app'] = [
            'id'                => $app->id,
            'name'              => $app->name,
            'about'             => $app->about,
            'email'             => $app->email,
            'phone'             => $app->hp,
            'url'               => $app->link,
            'address'           => $app->address,
            'rekening_name'     => $app->main_rekening_name,
            'rekening_number'   => $app->main_rekening,
            'bank_name'         => $app->main_rekening_bank,
            'announcement'      => $app->announcement,
            'fb'                => $app->fb,
            'twitter'           => $app->twitter,
            'ig'                => $app->ig,
            'logo'              => '/home-images/app/'.$app->logo,
        ];
        // dd($data);

        $levels = Level::where('status', 'p')->get();
        return view('backend.setting.main', compact('data', 'profile', 'channel_cek', 'levels'));
    }

    public function roleChange($data, $id){
        User::find($id)->update([
            'role' => $data,
            'updated_at' => Carbon::now()
        ]);
        return redirect('/dashboard/list_user')->with('sukses', '');
    }

    // TAMBAH LEVEL
    public function addLevel(Request $request){
        $levels = new Level;
        $levels->name = strtolower($request->level);
        $levels->status = 'p';
        $levels->created_at = Carbon::now();
        $levels->save();

        return redirect('/dashboard/admin/setting')->with('success', 'Level berhasil ditambah');
    }

    // DELETE LEVEL
    public function deleteLevel($id){
        Level::find($id)->delete();
        return back()->with('success', 'Level berhasil dihapus ');
    }

    public function action($data, $id){
        if($data == 'mute'){
            User::where('id', $id)->update([
                'status' => 'non-active',
                'updated_at' => Carbon::now()
            ]);
            // dd('berhasil');
            return back()->with(''.$data.'', '');

        }else if($data == 'unmute'){
            User::where('id', $id)->update([
                'status' => 'active',
                'updated_at' => Carbon::now()
            ]);
            // dd('berhasil');
            return back()->with(''.$data.'', '');

        }else if($data == 'delete'){
            // USE SOFT DELETE
            User::find($id)->delete();

            return back()->with(''.$data.'', '');

        }else if($data == 'edit'){
            $row = array();
            $users = User::where('id', $id)->first();

            return view('backend.user.edit', compact('users'));
        }
    }

    //HIDE and UNHIDE VIDEO
    public function setStatus(Request $request, $id, $s){
        // dd($s);
        if($s == 'h'){
          $update = DB::table('view_stream')->where('id', $id)->where('status', $s)->update([
            'status' => 'p',
            'updated_at' => Carbon::now()
          ]);
        }else{
          $update = DB::table('view_stream')->where('id', $id)->where('status', $s)->update([
            'status' => 'h',
            'updated_at' => Carbon::now()
          ]);
        }

        // $view_stream = DB::table('chanel')->where('id_user', auth()->user()->id)->first();
        return redirect('/dashboard/admin/materi')->with('sukses','Data berhasil di update');
    }

    public function partner(){
        $profile = DashboardController::userData(auth()->user()->id);
        $data = array();
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
        // dd($data);

        return view('backend.admin.partner', compact('profile', 'data'));
    }

    public function partnerAdd($id){
        $profile = DashboardController::userData(auth()->user()->id);

        if($id == 0) {
            $data = array();
            $data['id'] = '';
            $data['action'] = 'add';
            $data['title'] = '';
            $data['url'] = '';
            $data['path_image'] = '';
        }else{
            $file = 'public/backend/json/data_partner.json';
            $partner = file_get_contents($file);
            $data = json_decode($partner, true);

            foreach ($data as $k => $v) {
                if($v['id'] === $id){
                    $data['action'] = 'edit';
                    $data['id'] = $v['id'];
                    $data['title'] = $v['title'];
                    $data['url'] = $v['url'];
                    $data['status'] = $v['status'];
                    $data['date'] = $v['created_at'];
                    $data['path_image'] = asset($v['path_image']);
                }
            }
            // dd($data);
        }

        return view('backend.admin.partner_add', compact('profile', 'data'));
    }

    public function partnerSave(Request $request){
        // dd($request);
        $dateTime       = date('Y-m-d H:i:s');
        $updatedDateFormat =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('mdYHis');

        $id = $request->id;
        $title = $request->title;
        $url = $request->url;
        $image =  $request->partner_image;

        if(empty($image)){
            $file = 'public/backend/json/data_partner.json';
            $partner = file_get_contents($file);
            $data = json_decode($partner, true);

            foreach ($data as $k=>$v) {
                if ($v['id'] === $id) {
                    $data['partner'][$k]['path_image'] = $v['path_image'];
                }
            }
            $title_image = $data['partner'][0]['path_image'];
        }else{
            $title_image      = "partner"."-".$updatedDateFormat.$image->getClientOriginalname();
            $save             = $request->file('partner_image')->move('backend/image/partner/',$title_image);

        }

        $data_partner = 'public/backend/json/data_partner.json';
        $file = file_get_contents($data_partner);
        $data = json_decode($file, true);

        if($request->action == 'edit'){
            foreach ($data as $key => $v) {
                if($v['id'] === $id){
                    $data[$key]['title'] = $title;
                    $data[$key]['url'] = $url;
                    $data[$key]['path_image'] = $title_image;
                }
            }
        }else{
            $data[] = array(
                'id' => $updatedDateFormat,
                'title' => $title,
                'url' => $url,
                'path_image' => 'backend/image/partner/'.$title_image,
                'status' => 'p',
                'created_at' => date('Y-m-d h:m:s'),
            );
        }

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($data_partner, $jsonfile);
        return redirect('dashboard/admin/partner')->with('success', '');
    }

    public function partnerStatus($id, $action){
        $file = 'public/backend/json/data_partner.json';
        $partner = file_get_contents($file);
        $data = json_decode($partner, true);

        if($action == 'p'){
            $status = 'h';
        }else{
            $status = 'p';
        }

        foreach ($data as $key => $v) {
            if($v['id'] === $id){
                $data[$key]['status'] = $status;
            }
        }

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($file, $jsonfile);

        return redirect('dashboard/admin/partner')->with('hidden', '');

    }

    public function partnerDelete($id){
        $file = 'public/backend/json/data_partner.json';
        $partner = file_get_contents($file);
        $data = json_decode($partner, true);

        foreach ($data as $key => $v) {
            if($v['id'] === $id){
                array_splice($data, $key, 1);
            }
        }



        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($file, $jsonfile);

        return redirect('dashboard/admin/partner')->with('delete', '');

    }

    public function Withdraw(){
        $profile            = DashboardController::userData(auth()->user()->id);
        $data['income']     = AdminController::dataDashboard('total_income');
        $data['data']       = WithdrawModel::orderBy('created_at', 'desc')->get();
        // dd($data);
        return view('backend.withdraw.table_admin', compact(
            'profile',
            'data'
        ));
    }

    public function WithdrawAccept($id){
        try{
            $save = WithdrawModel::findOrFail($id);
            $save->status = 2;
            $save->accept_by = auth()->user()->id;
            $save->save();

            Alert::success('Sukses', 'Pastikan anda sudah melunasi tagihan pembayaran mentor');
            return redirect()->route('withdraw.admin');
        }catch(Exception $error){
            return redirect()->route('withdraw.index')->with('message', $error->getMessage());
        }
    }

    public function WithdrawCancel($id){
        try{
            $save = WithdrawModel::findOrFail($id);
            $save->status = 1;
            $save->accept_by = auth()->user()->id;
            $save->save();

            Alert::success('Dibatalkan', 'Permintaan berhasil dibatalkan');
            return redirect()->route('withdraw.admin');

        }catch(Exception $error){
            return redirect()->route('withdraw.admin')->with('message', $error->getMessage());
        }
    }

    public function WithdrawDelete($id){
        try{
            $save = WithdrawModel::findOrFail($id);
            $save->softDeletes();

            Alert::success('Terhapus', 'Data berhasil dihapus');
            return redirect()->route('withdraw.admin');

        }catch(Exception $error){
            return redirect()->route('withdraw.admin')->with('message', $error->getMessage());
        }
    }

    public function detailUser($id){
        $profile                    = DashboardController::userData(auth()->user()->id);
        $data['detail']             = DashboardController::userData($id);
        $data['subscribe_class']    = ClassRequest::where('member_id', $id)->get()->count();
        $data['riwayat_class']      = ClassRequest::where('member_id', $id)->get();
        if(isset($data['riwayat_class'])){
            foreach($data['riwayat_class'] as $k=>$v){
                $data['class'][$k]['title']     = ucwords($v->getClass->name);
                $data['class'][$k]['image']     = $v->getClass->image;
                $data['class'][$k]['total_materi']    = view_stream::where('class_id', $v->class_id)->get()->count();
                $data['class'][$k]['finish_materi']    = ClassHistory::where('class_id', $v->class_id)->get()->count();
                if($data['class'][$k]['finish_materi'] > $data['class'][$k]['total_materi']){
                    $data['class'][$k]['is_complete'] = 'Selesai';
                }else{
                    $data['class'][$k]['is_complete'] = 'Sedang Belajar';
                }
            }

        }
        // dd($data);
        return view('backend.user.detail', compact('profile', 'data'));
    }



    // STATIC FUNCTION
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

    public static function dataDashboard($name){
        // data user
        $data = array();
        switch($name){
            case 'user' :
                $row = User::all();
                $data = [
                  'total' => $row->count(),
                  'active' => $row->where('status', 'active')->count(),
                  'verified' => $row->whereNotNull('email_verified_at')->count(),
                ];
            break;
            case 'user_chart' :
                $row = ClassHistory::all();
                $data = [
                    'total_premium' => $row->where('premium', true)->count(),
                    'total_free' => $row->where('premium', false)->count(),
                  ];
            break;
            case 'materi' :
                $row = view_stream::all();
                $data = [
                  'total' => $row->count(),
                  'premium' => $row->where('premium', true)->count(),
                  'free' => $row->where('premium', false)->count(),
                ];
            break;
            case 'kelas' :
                $row = ClassMenu::all();
                $data = [
                  'total' => $row->count(),
                ];
            break;

            case 'role' :
                $mentor = User::where('role', 'teacher');
                $admin = User::where('role', 'admin');
                $data = [
                  'total_admin' => $admin->count(),
                  'total_mentor' => $mentor->count(),
                ];
            break;
            case 'total_income' :
                $total_class_pelanggan      = ClassMenu::pluck('class_id');
                $total_pelanggan_premium    = ClassRequest::where('premium', true)->get();
                $income_new                 = ClassRequest::where('premium', true)->orderBy('updated_at', 'desc')->first();
                $income_class               = ClassRequest::whereIn('class_id', $total_class_pelanggan)
                                                ->where('premium', true)
                                                ->orderBy('updated_at', 'desc')
                                                ->get();

                if(empty($income_class[0])){
                    $data['total_income'] = 0;
                    $sistem = 0;
                }else{
                    foreach ($income_class as $k => $v) {
                        $data['income'][$k] = $v->getClass->price;
                    }
                    $all_income = array_sum($data['income']);
                    $sistem = (10/100) * $all_income;
                    $data['total_income'] = $all_income - $sistem;
                }

                $data['total_all_income']   = $sistem;
                if(!empty($income_new)){
                    $data['new_income']         = $income_new->getClass->price;
                }else{
                    $data['new_income']         = 0;
                }
                // dd($data);
            break;
            default :
                $data = null;
        }


        return $data;
    }


}
