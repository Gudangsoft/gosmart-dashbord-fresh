<?php

namespace App\Http\Controllers;

use App\chanel;
use App\Http\Controllers\DashboardController;
use App\Models\ClassHistory;
use App\Models\ClassLinkage;
use App\Models\ClassMenu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\ClassLike;
use RecursiveDirectoryIterator;
use Alert;
use App\Models\ClassRequest;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    // LIST CLASS
    public function classList(){
        $data = array();

        $user = DetailController::user(auth()->user()->id);
        // dd($user['role']);
        if($user['role'] == 'admin'){
            $class = ClassMenu::orderBy('created_at', 'desc')->get();
            foreach($class as $k=>$v){
                $data['class'][$k]['class_id'] = $v->class_id;
                $data['class'][$k]['price'] = $v->price;
                $data['class'][$k]['discount'] = isset($v->discount) ? ($v->price - ($v->discount/100*$v->price)) : '0';
                $data['class'][$k]['name'] = $v->name;
                $data['class'][$k]['slug'] = $v->slug;
                $data['class'][$k]['status'] = $v->status;
                $data['class'][$k]['add_by'] = $v->getUser->name;
                $data['class'][$k]['add_date'] = $v->created_at;
                $data['class'][$k]['count_subs'] = ClassRequest::where('class_id', $v->class_id)->get()->count();
            }

        }else if($user['role'] == 'teacher'){
            $class = ClassMenu::where('add_by', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            // dd($class);
            if(empty($class[0])){
                return redirect('/dashboard/class_add/new')->with('msg', 'Silakan tambah kelas baru');
            }else{
                foreach($class as $k=>$v){
                    $data['class'][$k]['class_id'] = $v->class_id;
                    $data['class'][$k]['price'] = $v->price;
                    $data['class'][$k]['discount'] = $v->price ? ($v->price - ($v->discount/100*$v->price)) : '0';
                    $data['class'][$k]['slug'] = $v->slug;
                    $data['class'][$k]['name'] = $v->name;
                    $data['class'][$k]['status'] = $v->status;
                    $data['class'][$k]['add_by'] = $v->getUser->name;
                    $data['class'][$k]['add_date'] = $v->created_at;
                    $data['class'][$k]['count_subs'] = ClassRequest::where('class_id', $v->class_id)->get()->count();
                }
            }
        }
        $data['join'] = null;
        $id_user = auth()->user()->id;
        $channel_cek = chanel::where('id_user', $id_user)->first();
        $profile = self::profile(auth()->user()->id);
        return view('backend.class_list', compact('data', 'profile', 'channel_cek',));

    }

    public static function profile(){
        $takes_controller = new DashboardController;
        $profile = $takes_controller->userData(auth()->user()->id);
        return $profile;
    }

    public function joinClass(Request $request){
        $class_id   = $request->kelas;
        $parent_id  = $request->parent_id;
        // dd($request);
        $save = new ClassLinkage();
        $save->class_id     = $class_id;
        $save->class_parent = $parent_id;
        $save->add_by       = auth()->user()->id;
        $save->status       = 'p';
        $save->save();

        return redirect('/dashboard/join_class_list')->with('msg', 'Data berhasil ditambahkan');
    }

    //HIDE and UNHIDE COURSE
    public function classAction(Request $request, $id, $s){
        // dd($s);
        if($s == 'h'){
          $update = ClassMenu::where('class_id', $id)->where('status', $s)->update([
            'status' => 'p',
            'updated_at' => Carbon::now()
          ]);
          Alert::success('Status', 'Data berhasil di unhidde');
        }else{
          $update = ClassMenu::where('class_id', $id)->where('status', $s)->update([
            'status' => 'h',
            'updated_at' => Carbon::now()
          ]);
          Alert::success('Status', 'Data berhasil di hidden');
        }

        // $view_stream = DB::table('chanel')->where('id_user', auth()->user()->id)->first();
        return redirect('/dashboard/class_list');
      }

}
