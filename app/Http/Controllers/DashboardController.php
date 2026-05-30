<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\Confirm;
use DB;
use File;
use App\User;
use App\Models\class_menu;
use App\Models\Level;
use App\Models\Cart;
use App\Models\Voucher;
use App\Models\ClassMenu;
use App\Models\Certificate;
use App\Models\ToolsMateri;
use App\Models\ClassCategory;
use App\Models\ToolsLinkage;
use App\view_stream;
use App\chanel;
use App\Model\LogoMitra;
use App\Models\ChannelData;
use App\Models\ClassHistory;
use App\Models\ClassRequest;
use App\models\MentorData;
use App\Models\PaymentModel;
use App\Models\ProfileGacademy;
use App\Models\ReviewClassModel;
use App\Models\SkillModel;
use App\Models\UserData;
use App\Ua\MobileDetect;
use App\Ua\ImageManipulator;
use App\ResizeImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PagesModel as Pengumuman;
use App\Models\WithdrawModel;
use App\Http\Controllers\Backend\VoucherController;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $detect = new MobileDetect();
      if($detect->isMobile()){
        // header('')
        echo '<h2>Tampilan Mobile sedang dalam pengembangan...</h3>';
      }else{
        $view_stream = DB::table('chanel')->join('view_stream','view_stream.chanel_id','=','chanel.id')
        ->orderBy('visitor','asc')->paginate(8);

        $profile = self::userData(auth()->user()->id);
        $channel_cek = self::channelCek();
        return view('member.index', compact('view_stream', 'channel_cek', 'profile'));
      }
    }

    public function allmateri()
    {
        $data = array();

        $view_stream = view_stream::orderBy('created_at','desc')->paginate(30);
        // dd($view_stream);
        $profile = self::userData(auth()->user()->id);
        $channel_cek = self::channelCek();

        $data['class_filter'] = ClassMenu::all();
            foreach ($data['class_filter'] as $k => $v) {
                $data['class'][$k]['class_id'] = $v->class_id;
                $data['class'][$k]['class_name'] = $v->name;
            }
        return view('backend.all_materi',compact('data', 'view_stream', 'channel_cek', 'profile'));
    }

    public function user_materi($id){
        $data = array();

        $class_id = ClassMenu::where('add_by', $id)->pluck('class_id');
        $content = view_stream::whereIn('class_id', $class_id)->orderBy('created_at','desc')->paginate(20);
        // $ch = chanel::where('id_user', auth()->user()->id)->first();
        if($id == 0){
            $view_stream = null;
        }else{
            $view_stream = $content;
        }

        $profile = self::userData(auth()->user()->id);
        $channel_cek = self::channelCek();

        $data['class_filter'] = ClassMenu::where('add_by', $id)->get();
            foreach ($data['class_filter'] as $k => $v) {
                $data['class'][$k]['class_id'] = $v->class_id;
                $data['class'][$k]['class_name'] = $v->name;
            }

        return view('backend.user_materi',compact('data', 'view_stream', 'channel_cek', 'profile'));
    }

    public function materi_add($id){
        $tools = array();
        $data_tools = array();
        $kelas = ClassMenu::where('status', 'p')->where('add_by', auth()
                    ->user()->id)
                    ->orderBy('updated_at', 'desc')
                    ->get();
        $level = Level::where('status', 'p')->get();


        $tools_materi = ToolsMateri::all();
        $tools_count = $tools_materi->count();

        $data = array();
        if($id == 0){
            foreach ($kelas as $k => $v) {
                $data['class_list'][$k]['class_id']  = $v->class_id;
                $data['class_list'][$k]['name']      = $v->name;
            }
            $data['title_bar']  = "Tambah materi baru";
            $data['url']        = "video_add";
            $data['id']         = "";
            $data['judul']      = "";
            $data['link']       = "";
            $data['more_link']  = "";
            $data['keterangan'] = "";
            $data['gambar']     = "";
            $data['level']      = "";
            $data['level_name'] = "";
            $data['class_id']   = "";
            $data['class']      = "";
            $data['tags']       = "";
            // dd('tambah content');
            foreach($tools_materi as $key=>$value){
                $data_tools[$key]['tools_id'] = $value->id;
                $data_tools[$key]['tools_title'] = $value->title;
                $data_tools[$key]['tools_link'] = $value->link;
                $data_tools[$key]['check'] = false;

            }
        }else{
            $view_stream = view_stream::find($id);

            $data['title_bar']  = "Edit materi";
            $data['url']        = "video_update";
            $data['id']         = $view_stream->id;
            $data['judul']      = $view_stream->judul;
            $data['link']       = $view_stream->link;
            $data['more_link']  = $view_stream->file_pdf;
            $data['keterangan'] = $view_stream->keterangan;
            $data['class_id']   = $view_stream->getClass->class_id;
            $data['class']      = $view_stream->getClass->name;
            $data['level']      = $view_stream->level;
            // $data['level_name'] = $view_stream->getLevel->name;
            $data['gambar']     = asset('home-images').'/materi/'.$view_stream->gambar;
            $data['tags']       = $view_stream->tags;
            $arr_tools = explode(',', $view_stream->tools_id);

            foreach($tools_materi as $key=>$value){
                $data_tools[$key]['tools_id'] = $value->id;
                if(!empty($tools_materi)){
                    if(in_array($data_tools[$key]['tools_id'], $arr_tools)){
                        $data_tools[$key]['check'] = true;
                    }else{
                        $data_tools[$key]['check'] = false;
                    }
                }

                $data_tools[$key]['tools_title'] = $value->title;
                $data_tools[$key]['tools_link'] = $value->link;
            }
        }

        $profile = self::userData(auth()->user()->id);
        $channel_cek = self::channelCek();
        // dd($data);
        return view('backend.video_form', compact('channel_cek', 'profile', 'kelas', 'level', 'tools_materi'), [
            'data' => $data,
            'data_tools' => $data_tools,
            'tools' => $tools,
        ]);
    }



    //update video
    public function videoUpdate(Request $req)
    {
        $data = array();
        $tools = $req->input('tools');
        if(!empty($tools)){
            $select = implode(",", $tools);
        }

        // dd($req);
        $class_id = $req->siteID;
        $materi_id = $req->materi_id;
        $action = $req->action;
        $url_materi = $req->url_materi;
        $count_materi = count($url_materi);

        $get_class = ClassMenu::where('class_id', $class_id)->first();

        if(empty($materi_id)){
            for($i=0; $i<$count_materi; $i++){
                // dd($i);
                $url = $url_materi[$i];
                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
                $youtube_id[$i] = $matches[1];
                // dd($youtube_id[0]);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$youtube_id[$i].'&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $result[$i] = curl_exec($curl);
                curl_close($curl);
                $result[$i] = json_decode($result[$i], true);
                // dd($result[$i]);
                $data[$i]['title'] = $result[$i]['items'][0]['snippet']['title'];

                $materi             = new view_stream();
                $materi->judul      = $data[$i]['title'];
                $materi->link       = $url_materi[$i];
                $materi->slug       = $youtube_id[$i];
                $materi->premium    = $get_class->premium;
                $materi->class_id   = $class_id;
                $materi->status     = 'p';
                $materi->save();
            }
        Alert::success('Sukses', 'Materi berhasil ditambahkan');

        }else{
            $url = $url_materi[0];
                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
                $youtube_id = $matches[1];
                // dd($youtube_id[0]);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$youtube_id.'&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($result, true);
                // dd($result[$i]);
                $data['title'] = $result['items'][0]['snippet']['title'];

                $materi             = view_stream::where('id', $materi_id)->update([
                    'judul' => $data['title'],
                    'link' => $url_materi[0],
                    'slug' => $youtube_id,
                ]);
        Alert::success('Sukses', 'Materi berhasil diubah');

        }


        // $id_user = auth()->user()->id;
        // $img = "";
        // $action = "";
        // if($data == "video_add"){
        //     $img = 'mimes:jpeg,png|max:6000|required';
        //     $action = "add";

        //     $rules = [

        //         'link' => 'required',
        //         'judul' => 'required|unique:view_stream',
        //         'keterangan' => 'required',
        //         'gambar' => $img,
        //         'kelas' => 'required',
        //         'level' => 'required',
        //         'tags' => 'required',
        //     ];

        //     $message = [

        //     'link.required' => 'link harus di isi',
        //     'judul.required' => 'judul harus di isi',
        //     'keterangan.required' => 'Keterangan harus di isi',
        //     'gambar.mimes' => 'ekstensi gambar harus jpg atau png',
        //     'gambar.max' => $img,
        //     'kelas.required' => 'kelas harus di isi',
        //     'level.required' => 'level harus di isi',
        //     'tags.required' => 'tags harus di isi',

        //     ];
        //     $this->validate($req, $rules, $message);
        // }else{
        //     $img = 'mimes:jpeg,png|max:6000';
        //     $action = "edit";
        // }



        //     $image = view_stream::where('id','=',$req->id)->value('gambar');
        //     // dd($image);
        //     $chanel_id  = DB::table('chanel')->where('id_user','=',$id)->value('id');
        //     $link       = $req->link;
        //     $more_link  = $req->more_link;
        //     $premium    = $req->pre;
        //     $judul      = ucfirst($req->judul);
        //     $slug       = strtolower(str_replace(' ', '-', $judul));
        //     $keterangan = $req->keterangan;
        //     $class      = $req->kelas;
        //     $level      = $req->level;
        //     $tags       = strtolower($req->tags);
        //     $t          = explode(",", $tags );
        //     $d          = array();
        //     $d          = [
        //                     'ta' => $t
        //                 ];
        //     $count_tags = count($d['ta']);
        //         if($count_tags < 2){
        //         return back()->with('alert', 'Tags minimal 2 kata');
        //         }
        //     // dd($count);
        //     $gambar = $req->gambar;
        //     if($gambar != null){
        //         $gambar_tipe = $req->gambar->extension();
        //         if(is_file(public_path('home-images/materi/'. $image))){
        //             unlink(public_path('home-images/materi/'. $image));
        //         }
        //         list($width, $height, $type, $attr) = getimagesize($gambar);
        //         // dd($gambar_tipe);
        //         if($width < 90 || $height < 93){
        //         // if($width < 890 || $height < 593){
        //             $title = substr($judul, 0, 30);
        //             $des = '';

        //             if(strlen($title) >= 30 || $des >= 50){
        //                 $title_cut = $title."...";
        //                 $des_cut = $des."...";
        //             }else{
        //                 $title_cut = $title;
        //                 $des_cut = $des;
        //             }

        //             $font_ttf = realpath("backend/dist/css/font-awesome/fonts/arial.ttf");
        //             $img_w = 890;
        //             $img_h = 593;
        //             $image = imagecreatetruecolor($img_w, $img_h);
        //             $bg = imagecolorallocate($image, 0, 204, 102);
        //             $putih = imagecolorallocate($image, 255, 255, 255);
        //             imagefill($image, 0, 0, $bg);

        //             imagettftext($image, 40, 0, 20, ($img_h/2), $putih, $font_ttf, $title_cut);
        //             imagettftext($image, 20, 0, 20, ($img_h/2)+50, $putih, $font_ttf, $des_cut);

        //             $gambar = "view_stream-".$id_user."-".$req->gambar->getClientOriginalname();
        //             $g = substr($gambar, 0, -4);
        //             // dd($g);
        //             $save = "home-images/materi/".$g.".".$gambar_tipe;

        //                 if($gambar_tipe == 'png'){
        //                     imagepng($image, $save);
        //                 }else{
        //                     imagejpeg($image, $save);
        //                 }

        //             imagedestroy($image);

        //             // dd('minimal foto ukuran 890 x 593 pixel');

        //         }else{
        //             $gambar = "view_stream-".$id_user."-".$req->gambar->getClientOriginalname();
        //             $save = $req->file('gambar')->move('home-images/materi/',$gambar);
        //         }
        //     }else{
        //         $gambar = $image;
        //     }

        //     //CROP img
        //     // $im = new ImageManipulator('home-images/'.$gambar);
        //     // $centerX = round($im->getWidth()/2);
        //     // $centerY = round($im->getHeight()/2);

        //     // $x1 = $centerX - 100;
        //     // $y1 = $centerY - 100;

        //     // $x2 = $centerX + 100;
        //     // $y2 = $centerY + 100;

        //     // $im->crop($x1, $y1, $x2, $y2);
        //     // $im->save('home-images/croped/'.$gambar);

        //     if($action == "edit"){
        //         $home = DB::table('view_stream')->where('id','=',$req->id)->update([
        //         'link' => $link,
        //         'premium' => $premium,
        //         'file_pdf' => $more_link,
        //         'judul' => $judul,
        //         'slug' => $slug,
        //         'keterangan' => $keterangan,
        //         'gambar' => $gambar,
        //         'class_id' => $class,
        //         'level' => $level,
        //         'tags' => $tags,
        //         'tools_id' => $select,
        //         'updated_at' => Carbon::now()
        //         ]);
        //     }
        //     else if($action == "add"){
        //         $home = DB::table('view_stream')->insert([
        //         'link' => $link,
        //         'premium' => $premium,
        //         'file_pdf' => $more_link,
        //         'judul' => $judul,
        //         'slug' => $slug,
        //         'keterangan' => $keterangan,
        //         'gambar' => $gambar,
        //         'class_id' => $class,
        //         'level' => $level,
        //         'tags' => $tags,
        //         'status' => 'p',
        //         'chanel_id' => $chanel_id,
        //         'tools_id' => $select,
        //         'updated_at' => Carbon::now()
        //         ]);
        //     }

        $id_user = auth()->user()->id;

        return redirect('/dashboard/user_materi/'.$id_user.'')->with('sukses','Data berhasil di update');

    }


    //DELETE VIDEO
    public function videoDelete($id){
        $uid = auth()->user()->id;
        $class_id = ClassMenu::where('add_by', $uid)->pluck('class_id');
        $content = view_stream::whereIn('class_id', $class_id)->orderBy('created_at','desc')->paginate(20);

        if($uid == 0){
            $view_stream = null;
        }else{
            $view_stream = $content;
        }

        $profile = self::userData($uid);
        $channel_cek = self::channelCek();

        $data['class_filter'] = ClassMenu::where('add_by', $id)->get();
            foreach ($data['class_filter'] as $k => $v) {
                $data['class'][$k]['class_id'] = $v->class_id;
                $data['class'][$k]['class_name'] = $v->name;
            }

        $materi_delete = DB::table('view_stream')->where('id','=',$id)->delete();
        // return back()->with('delete','Data Delete Success');
        Alert::error('Terhapus', 'Data berhasil dihapus');
        return view('backend.user_materi',compact('data', 'view_stream', 'channel_cek', 'profile'));
    }

    //HIDE and UNHIDE VIDEO
    public function setStatus(Request $request, $id, $s){
      // dd($s);
      if($s == 'h'){
        $update = DB::table('view_stream')->where('id', $id)->where('status', $s)->update([
          'status' => 'p',
          'updated_at' => Carbon::now()
        ]);
        Alert::info('Tampil', 'Data berhasil ditampilkan');
      }else{
        $update = DB::table('view_stream')->where('id', $id)->where('status', $s)->update([
          'status' => 'h',
          'updated_at' => Carbon::now()
        ]);
        Alert::warning('Tersembunyi', 'Data berhasil disembunyikan');
      }

      // $view_stream = DB::table('chanel')->where('id_user', auth()->user()->id)->first();
      return redirect('/dashboard/user_materi/'.auth()->user()->id.'')->with('sukses','Data berhasil di update');
    }

    public function videoDetail($id){
      $data = array();
      // $video = DB::select('view_stream')->where('id', $id)->orderBy('created_at','desc')->first();
      $view_stream = DB::table('chanel')->join('view_stream','view_stream.chanel_id','=','chanel.id')
      ->orderBy('created_at','desc')->where('view_stream.id', $id)->get();
      // $data['title'] = $view_stream->judul;
      foreach ($view_stream as $k => $v){} {
        $data['judul'] = $v->judul;
        $data['link'] = $v->link;
      }
      // dd($data);
      return view('backend.video_detail', [
        'data' => $data
      ]);
    }

    public function cari(Request $request)
    {
      $cari = $request->search;
      $view_stream = DB::table('chanel')->join('view_stream','view_stream.chanel_id','=','chanel.id')
      ->where('kategori','like',"%".$cari."%")->orWhere('judul','like',"%".$cari."%")->orWhere('keterangan','like',"%".$cari."%")
      ->orWhere('tags','like',"%".$cari."%")
      ->paginate(8);
      // dd($view_stream);

      $profile = self::userData(auth()->user()->id);
      $channel_cek = self::channelCek();
      if(auth()->user()->role == "member"){
        // dd('untuk user');
        return view('member.result_search',compact('view_stream', 'cari', 'channel_cek', 'profile'));
      }else{
        return view('backend.result_search',compact('view_stream', 'cari', 'channel_cek', 'profile'));
      }
    }

    // ADD NEW CHANNEL
    public function channelAdd($id){
        $channel = chanel::where('id', $id)->first();

        if(empty($channel)){
            $data = [
                'id' => '',
                'name' => '',
                'url' => '',
                'description' => '',
                'picture' => '',
            ];
        }else{
            $data = [
                'id' => $channel->id,
                'name' => $channel->nama_chanel,
                'url' => $channel->link_chanel,
                'description' => $channel->deskripsi,
                'picture' => '/chanel-image/'.$channel->chanel_img,
            ];
        }
        // dd($data);
        $profile = self::userData(auth()->user()->id);
        $channel_cek = self::channelCek();
        return view('backend.add_channel', compact('channel_cek', 'profile', 'data'));
    }

    // CEK CHENNEL
    public static function channelCek(){
      $id_user = auth()->user()->id;
      $channel = DB::table('chanel')->where('id_user', $id_user)->first();
      // dd($channel);
      return $channel;
    }

    // Detail Kelas Dasboard
    public function classDetail($id){
        $data = array();

        $data['data']       = self::DataClass($id, 10);
        $data['content']    = self::DataContent($id, 10);
        $data['review']     = DetailController::review($id, 10);
        $data['voucher']    = Voucher::where('class_id', $id)->orderBy('updated_at', 'desc')->get();
        // dd($data);

        $profile = self::userData(auth()->user()->id);
        return view('backend.class.detail', compact('data', 'profile'))->with('detail', 'detail');
    }

    //class_menu ADD
    public function classAdd($id){
        $data           = array();
        $level_id       = ClassMenu::where('class_id', $id)->first();
        $tools_materi   = ToolsMateri::all();
        $tools_count    = $tools_materi->count();

        if($id == 'new'){
            $data = array(
                'action'        => 'create',
                'category_id'   => '',
                'class_id'      => '',
                'title'         => '',
                'description'   => 'Deskripsi kelas',
                'price'         => '',
                'discount'      => '',
                'image'         => '',
                'tags'          => '',
            );


            if(empty($level_id)){
                $data['level']      = "";
                $data['level_name'] = "";
            }

            foreach($tools_materi as $key=>$value){
                $data_tools[$key]['tools_id'] = $value->id;
                $data_tools[$key]['tools_title'] = $value->title;
                $data_tools[$key]['tools_link'] = $value->link;
                $data_tools[$key]['check'] = false;

            }
            // dd($tools_materi);
        }else{
            $class  = ClassMenu::where('class_id', $id)->orderBy('created_at', 'desc')->first();
            $data = array(
                'action'        => 'update',
                'category_id'   => $class->category_id,
                'category_name' => isset($class->getCategory->title) ? Str::upper($class->getCategory->title) : null,
                'class_id'      => $class->class_id,
                'title'         => $class->name,
                'description'   => html_entity_decode($class->description),
                'price'         => (int)$class->price,
                'discount'      => (int)$class->discount,
                'image'         => asset('home-images').'/kelas/thumbnail/'.$class->image,
                'tags'          => $class->tags,
                'is_premium'    => $class->premium

            );

            $materi = view_stream::where('class_id', $id)->get();
            foreach ($materi as $k => $v) {
                $data['materi'][$k]['url'] = $v->link;
            }

            if(empty($level_id)){
                $data['level']      = "";
                $data['level_name'] = "";
            }else{
                $data['level']      = $level_id->level_id;
                $data['level_name'] = $level_id->getLevel->name;
            }


            if(!empty($class)){
                $arr_tools = explode(',', $class->tools_id);
            }

            foreach($tools_materi as $key=>$value){
                $data_tools[$key]['tools_id'] = $value->id;
                if(!empty($tools_materi)){
                    if(in_array($data_tools[$key]['tools_id'], $arr_tools)){
                        $data_tools[$key]['check'] = true;
                    }else{
                        $data_tools[$key]['check'] = false;
                    }
                }

                $data_tools[$key]['tools_title'] = $value->title;
                $data_tools[$key]['tools_link'] = $value->link;
            }
        }

        $data['level_list'] = Level::where('status', 'p')->get();
        $data['category']   = ClassCategory::where('status', 1)->get();
        $class_menu = ClassMenu::where('status', 'p')->orderBy('created_at', 'desc')->paginate(6);
        $profile = self::userData(auth()->user()->id);
        $channel_cek = self::channelCek();
        return view('backend.add_class', compact('channel_cek', 'profile', 'class_menu'), [
            'data' => $data,
            'data_tools' => $data_tools,
        ]);
    }

    public function classDelete($id){
        ClassMenu::where('class_id', $id)->delete();
        Alert::error('Terhapus', 'Data berhasil dihapus');
        return back();

    }


    public function classSave(Request $request){
        // dd($request);
        $data           = array();
        $dateTime       = date('Y-m-d H:i:s');
        $category_id    = $request->category_id;
        $updatedDateFormat =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('mdYHis');
        $class_id       = $request->class_id;
        $name           = $request->name;
        $slug           = strtolower(str_replace(' ', '-', $name));
        $description    = $request->description;
        $action         = $request->action;
        $q              = '';
        $img            = '';
        $folder_first   = 'home-images/kelas/';
        $folder_second  = 'home-images/kelas/thumbnail/';

        $price          = $request->price ? $request->price : '0';
        $discount       = $request->discount ? $request->discount : '0';
        $cek_koma       = preg_match('/,/i', $price);
        $cek_precent    = preg_match('/%/i', $discount);

        if($cek_koma == true){
            $dot_price = str_replace(',', '', $price);
        }else{
            $dot_price = str_replace('.', '', $price);
        }

        if($cek_precent == true){
            $precent = str_replace('%', '', $discount);
        }else{
            $precent = str_replace('.', '', $discount);
        }

        $price_old      = ClassMenu::where('class_id', $class_id)->value('price');

        $plusPrecent = $dot_price == $price_old ? 0 : ((10/100)*(int)$dot_price);
        $priceNow = (int)$dot_price + (int)$plusPrecent;

        $gambar         = $request->image;
        $premium        = $request->premium;
        $tags           = $request->tags;
        $level          = $request->level;
        $tools          = $request->tools;
        $source_url     = $request->source_url;

        if(!empty($tools)){
            $select_tools = implode(",", $tools);
        }else{
            $select_tools = null;
        }

        $url_materi     = $request->url_materi;

        $gambar_old     = ClassMenu::where('class_id', $class_id)->value('image');

        if($action == "create"){
            $n = 'string|max:255|unique:class_menu';
            $img = 'mimes:jpeg,png|max:6000|required|dimensions:min_width=400,min_height=400,max_width=3000,max_height=3000';
            $q = "add";
          }else{
            $n = 'string|max:255';
            $img = 'mimes:jpeg,png|max:6000|dimensions:min_width=400,min_height=400,max_width=3000,max_height=3000';
            $q = "edit";
          }

        $val = [
            'name' => $n,
            'price' => 'max:255',
            'image' => $img,
        ];

        $msg = [
            'name.unique' => 'Nama kelas '.$request->name.' sudah ada !',
            'image.dimensions' => 'Resolusi gambar minimal 400x400 pixel'
        ];
        $cek = $this->validate($request, $val, $msg);

        if($cek){
            if(empty($gambar)){
                $image_crop_name = $gambar_old;
            }else{
                if(is_file(public_path($folder_second.$gambar_old))){
                    unlink(public_path($folder_second.$gambar_old));
                    $gambarx = $updatedDateFormat.auth()->user()->id.$request->image->getClientOriginalname();
                    $save = $request->file('image')->move($folder_first,$gambarx);
                    $image_crop_name = ResizeImage::resizeImage($gambarx, $name, $folder_first, $folder_second)['file_name'];
                }else{
                    $gambarx = $updatedDateFormat.auth()->user()->id.$request->image->getClientOriginalname();
                    $save = $request->file('image')->move($folder_first,$gambarx);
                    $image_crop_name = ResizeImage::resizeImage($gambarx, $name, $folder_first, $folder_second)['file_name'];
                }
            }

            $channel_id     = chanel::where('id_user', auth()->user()->id)->value('id');

            if($action == "create"){
                $class_menu                 = new ClassMenu();
                $class_menu->category_id    = $category_id;
                $class_menu->name           = strtolower($name);
                $class_menu->slug           = $slug;
                $class_menu->description    = htmlentities($description, ENT_QUOTES);
                $class_menu->image          = $image_crop_name;
                $class_menu->premium        = $premium;
                $class_menu->tags           = $tags;
                $class_menu->level_id       = $level;
                $class_menu->tools_id       = $select_tools;
                $class_menu->source_url     = $source_url;
                $class_menu->status         = 'p';
                $class_menu->price          = (int)$priceNow;
                $class_menu->discount       = (int)$precent == 0 || empty((int)$precent) ? null : (int)$precent;
                $class_menu->add_by         = auth()->user()->id;
                $class_menu->save();

                $count_materi   = count($url_materi);
                $get_class_id = ClassMenu::latest('class_id')->value('class_id');
                for($i=0; $i<$count_materi; $i++){

                    $url = $url_materi[$i];
                    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
                    $youtube_id[$i] = $matches[1];

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$youtube_id[$i].'&key=AIzaSyCtPvMxXtRjFl3UuFvGNHTg7GKqnHoMEd8');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $result[$i] = curl_exec($curl);
                    curl_close($curl);
                    $result[$i] = json_decode($result[$i], true);
                    // dd($result[$i]);
                    $data[$i]['title'] = $result[$i]['items'][0]['snippet']['title'];

                    $materi             = new view_stream();
                    $materi->judul      = $data[$i]['title'];
                    $materi->link       = $url_materi[$i];
                    $materi->slug       = $youtube_id[$i];
                    $materi->chanel_id  = $channel_id;
                    $materi->premium    = $premium;
                    $materi->class_id   = $get_class_id;
                    $materi->status     = 'p';
                    $materi->save();
                }

            }else if($action == 'update'){
                $update = ClassMenu::where('class_id', $class_id)->update([
                    'name'          => $name,
                    'category_id'   => $category_id,
                    'slug'          => $slug,
                    'description'   => htmlentities($description, ENT_QUOTES),
                    'price'         => (int)$priceNow,
                    'discount'      => (int)$precent == 0 || empty((int)$precent) ? null : (int)$precent,
                    'premium'       => $premium,
                    'tags'          => $tags,
                    'level_id'      => $level,
                    'tools_id'      => $select_tools,
                    'source_url'    => $source_url,
                    'image'         => $image_crop_name,
                ]);

                Alert::success('Sukses', 'Kelas berhasil diupdate');

                return redirect('/dashboard/class_list')->with('msg', 'Data berhasil diubah');
            }
        }
        Alert::success('Sukses', 'Kelas berhasil ditambahkan');
        return redirect('/dashboard/class_list');
    }

    // LIST SERTIFIKAT
    public function certificateList(){
        $rows = Certificate::where('add_by', auth()->user()->id)->where('status', 'p')->paginate(10);
        // dd($rows->materi->judul);

        $channel_cek = self::channelCek();
        $profile = self::userData(auth()->user()->id);
        return view('backend.certificate', compact('channel_cek', 'profile', 'rows'));
    }

    // UPLOAD SERTIFIKAT
    public function certificateAdd(){
        // dd($id);
        $data = array();
        $data['mitra_image'] =LogoMitra::where('add_by', auth()->user()->id)->value('url_image');

        $user_id  = chanel::where('id_user', auth()->user()->id)->value('id');
        $kelas = ClassMenu::where('status', 'p')->where('add_by', auth()->user()->id)->get();
        $materi = view_stream::where('chanel_id', $user_id)->where('status', 'p')->get();

        $channel_cek = self::channelCek();
        $profile = self::userData(auth()->user()->id);
        //   dd($materi);
        return view('backend.certificate_form', compact('channel_cek', 'profile', 'kelas'), [
            'data' => $data
      ]);
    }

    // UPLOAD TOOLS MATERI
    public function toolsMateriUpdate($id){
        $channel_cek = self::channelCek();
        $profile = self::userData(auth()->user()->id);
        $tools = ToolsMateri::where('id', $id)->first();

        return view('backend.tools_materi.form', compact('tools', 'channel_cek', 'profile'));
    }

    // SAVE TOOLS MATERI
    public function toolsMateriSave(Request $request){

        $rules = [
            // 'nama_lengkap' => 'required',
            'title' => 'required',
            'url' => 'required',
            // 'tools_img' => 'mimes:jpeg,png|max:4000',

        ];

        $this->validate($request,$rules);

        $title          = $request->title;
        $url            = $request->url;
        $tools_id       = $request->id;

        // dd($request);
        if(empty($request->tools_img)){
            $tools_img = 'default.png';
        }else{
            $tools_img      = "tools"."-".$request->tools_img->getClientOriginalname();
            $save           = $request->file('tools_img')->move('backend/image/tools-materi/',$tools_img);
        }

        // dd($save);
        if(empty($tools_id)){
            $s = new ToolsMateri;
            $s->title = html_entity_decode($title);
            $s->link = $url;
            $s->image = $tools_img;
            $s->user_id = auth()->user()->id;
            $s->save();
        }else{
            $update = ToolsMateri::where('id', $tools_id)->update([
                'title' => html_entity_decode($title),
                'link' => $url,
                'image' => $tools_img,
            ]);
        }

        return redirect('/dashboard/tools_materi/')->with('success', 'Data berhasil ditambahkan');
    }

    // DELETE TOOLS MATERI
    public function toolsMateriDelete($id){
        ToolsMateri::where('id','=',$id)->delete();

        return redirect('/dashboard/tools_materi/')->with('danger', 'Data berhasil dihapus');
    }

    // SERTIFIKAT SAVE
    public function certificateSave(Request $request){
        // dd($request);
        $mitra_url_file = '/img/certificate/logo';
        $mitra_logo = $mitra_url_file.'/'.$request->mitra;
        $mitra_logo_old = LogoMitra::where('add_by', auth()->user()->id)->where('class_id', $request->class_id)->value('url_image');

        if(!empty($request->mitra)){
            list($width, $height) = getimagesize($request->mitra);
            if($width > 1000 || $height > 1000){
                return back()->with('error', 'Image max 1000x1000 pixel');
            }else{
                if($request->mitra->getClientOriginalExtension() == 'png'){
                    if(empty($mitra_logo)){
                        $mitra_logo = $mitra_logo_old;
                    }else{
                        if(is_file(public_path($mitra_logo_old))){
                            unlink(public_path($mitra_logo_old));
                            $mitra_logo = "mitra-".auth()->user()->id.".png";
                            $save = $request->file('mitra')->move('img/certificate/logo/',$mitra_logo);
                        }else{
                            $mitra_logo = "mitra-".auth()->user()->id.".png";
                            $save = $request->file('mitra')->move('img/certificate/logo/',$mitra_logo);
                        }
                    }
                }else{
                    return back()->with('error', 'Format image hanya mendukung PNG');
                }
            }
        }else{
            $mitra_old_save = $mitra_logo_old;
        }

        if($mitra_logo_old == null){
            $mitra_save = new LogoMitra();
            if(!empty($request->mitra)){
                $mitra_save->url_image = $mitra_url_file.'/'.$mitra_logo;
            }else{
                $mitra_save->url_image = $mitra_old_save;
            }
            $mitra_save->add_by = auth()->user()->id;
            $mitra_save->class_id = $request->class_id;
            $mitra_save->status = 'p';
            $mitra_save->save();
        }else{
            LogoMitra::where('class_id', $request->class_id)->where('add_by', auth()->user()->id)
                        ->update([
                            'url_image' => !empty($request->mitra) ? ($mitra_url_file.'/'.$mitra_logo) : ($mitra_old_save),
                            'add_by' => auth()->user()->id,
                            'class_id' => $request->class_id,
                        ]);
        }

      return back()->with('success', 'Mitra berhasil ditambahkan');
    }

    // dd($channel);
    public function home(){

        $id_user = auth()->user()->id;
        $role = auth()->user()->role;
        if($role == "member"){
            return redirect('/learning');
        }

        $channel_cek = chanel::where('id_user', $id_user)->first();
        $profile = self::userData(auth()->user()->id);

        $top_content = self::topContent();
        $percent = ($top_content['data']['total']) - ($profile['total_materi']);
        $total_percent = $top_content['data']['total']*100;

        $data = [
            'data_user' => AdminController::dataDashboard('user'),
            'data_materi' => AdminController::dataDashboard('materi'),
            'data_kelas' => AdminController::dataDashboard('kelas'),
            'total_role' => AdminController::dataDashboard('role'),
            'total_income' => AdminController::dataDashboard('total_income'),
            'top' => $total_percent,
            'to_top' => $percent,
        ];
        $info = Pengumuman::latest('id')->first();
        if($info->type == 1){
            Alert::html('Info', $info->title, 'info')
                    ->showConfirmButton(
                        $btnText = '<a style="color:#fff" href="https://gosmart.id/announcement/'.$info->slug.'">Detail</a>'
                        )
                    ->showCancelButton(
                        $btnText = 'Cancel', $btnColor = '#aaa'
                    );
        }
        // dd($data);
        return view('backend.dashboard', compact('channel_cek', 'profile', 'data'));
    }

    public function profileSettingSave(Request $request){
        $id         = auth()->user()->id;
        $fullname   = ucwords($request->fullname);
        $email      = $request->email;
        $phone      = $request->phone;
        $photo      = $request->photo;
        $signature_url = 'img/certificate/signature';
        $signature  = $signature_url.'/'.$request->signature;
        $education  = $request->education;
        $skill      = str_replace(" ", "", $request->skill);
        $bio        = html_entity_decode($request->description);
        $address    = $request->address;
        $bank       = $request->bank;
        $no_rekening    = $request->no_rekening;
        $owner_name     = $request->owner_name;
        $folder_first   = 'img/user/avatar/';
        $folder_second  = 'img/user/avatar/';

        $user_data_cek = UserData::where('user_id', auth()->user()->id)->first();
        $payment_data_cek = PaymentModel::where('user_id', auth()->user()->id)->first();
        $photo_old = User::where('id', $id)->value('photo');
        $signature_old = UserData::where('user_id', $id)->value('signature_url');

        if(empty($photo)){
            $photo = $photo_old;
        }else{
            if(is_file(public_path($folder_second.$photo_old))){
                unlink(public_path($folder_second.$photo_old));
                $avatar = $request->photo->storePublicly('avatar', 'public');
                $photo = "view_stream-".$id."-".$request->photo->getClientOriginalname();
                $save = $request->file('photo')->move($folder_first,$avatar);
                // $image_crop_name = ResizeImage::resizeImage($avatar, $fullname, $folder_first, $folder_second)['file_name'];

            }else{
                $avatar = $request->photo->storePublicly('avatar', 'public');
                $photo = "view_stream-".$id."-".$request->photo->getClientOriginalname();
                $save = $request->file('photo')->move($folder_first,$avatar);
                // $image_crop_name = ResizeImage::resizeImage($avatar, $fullname, $folder_first, $folder_second)['file_name'];
            }
        }

        if(!empty($request->signature)){
            list($width, $height) = getimagesize($request->signature);
            if($width > 1280 || $height > 766){
                return back()->with('error', 'Image tanda tangan maksimal 1280x766');
            }else{
                if($request->signature->getClientOriginalExtension() != 'png'){
                    return back()->with('error', 'Format tanda tangan harus .png');
                }else{
                    if(empty($signature)){
                        $signature = $signature_old;
                    }else{
                        if(is_file(public_path($signature_old))){
                            unlink(public_path($signature_old));
                            $signature = "mentor-".$id.".png";
                            $save = $request->file('signature')->move('img/certificate/signature/',$signature);
                        }else{
                            $signature = "mentor-".$id.".png";
                            $save = $request->file('signature')->move('img/certificate/signature/',$signature);
                        }
                    }
                }
            }
        }else{
            $signature_old_save = $signature_old;
        }

        $rules = [
            'fullname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        $this->validate($request,$rules);

        User::where('id', auth()->user()->id)->update([
            'name'  => $fullname,
            'email' => $email,
            'phone' => $phone,
            'photo' => isset($avatar) ? $avatar : $photo_old,
            'address' => $address,
        ]);

        if($user_data_cek == null){
            $user_data = new UserData();
            $user_data->user_id = auth()->user()->id;
            $user_data->expert = $skill;
            $user_data->education = $education;
            $user_data->bio = $bio;
            if (!empty($request->signature)) {
                $user_data->signature_url = $signature_url.'/'.$signature;
            }else{
                $user_data->signature_url = $signature_old_save;
            }
            $user_data->save();
        }else{
            UserData::where('user_id', $id)->update([
                'expert' => $skill,
                'education' => $education,
                'bio' => $bio,
                'signature_url' => !empty($request->signature) ? ($signature_url.'/'.$signature) : ($signature_old_save),
            ]);
        }

        if($payment_data_cek == null){
            $user_data = new PaymentModel();
            $user_data->user_id = auth()->user()->id;
            $user_data->bank_name = $bank;
            $user_data->no_rekening = $no_rekening;
            $user_data->owner_name = $owner_name;
            $user_data->save();
        }else{
            PaymentModel::where('user_id', $id)->update([
                'bank_name' => $bank,
                'no_rekening' => $no_rekening,
                'owner_name' => $owner_name,
            ]);
        }


        return redirect('/dashboard/profile/'.$id)->with('msg', 'Data telah diupdate');

    }

    public static function userData($id){
        $verified_chceck = User::where('id', $id)
                            ->whereNotNull('email_verified_at')
                            ->find($id);

        $data = array();
        $app = ProfileGacademy::where('id', 1)->where('status', 'p')->first();
        $data['app'] = [
            'id' => $app->id,
            'name' => $app->name,
            'email' => $app->email,
            'phone' => $app->hp,
            'url' => $app->link,
            'address' => $app->address,
            'logo' => 'home-images/app/'.$app->logo,
        ];

        $data['resetPassword']  = '/reset-password';

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
        $data['user_education'] = isset($user->userData->education) ? $user->userData->education : null;
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

        // TOTAL CLASS
        $total_all      = ClassMenu::all()->count();
        $total_class    = ClassMenu::where('add_by', $id)->get()->count();

        // dd($total_class);
        $data['total_class'] = $total_class;

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



            if($total_all > 0 && $total_class > 0){
                $data['precent_class'] = ($total_class/$total_all)*100;
            }else{
                $data['precent_class'] = 0;
            }

            // TOTAL PELANGGAN
            $total_class_pelanggan          = ClassMenu::where('add_by', $id)->pluck('class_id');
            $total_class_pelanggan_premium  = ClassMenu::where('add_by', $id)->where('premium', true)->pluck('class_id');
            $total_pelanggan_all            = ClassRequest::all()->count();
            $total_pelanggan                = ClassRequest::whereIn('class_id', $total_class_pelanggan)->where('premium', true)->get()->count();
            $data['total_pelanggan']        = $total_pelanggan;

            if($total_pelanggan_all > 0 && $total_pelanggan > 0){
                $data['precent_pelanggan'] = $total_pelanggan/$total_pelanggan_all*100;
            }else{
                $data['precent_pelanggan'] = 0;
            }

            // kode voucher
            $redeem = Voucher::whereIn('class_id', $total_class_pelanggan_premium)->where('status', 2)->sum('discount');
            $is_redeem = $redeem ? $redeem : 0;

            // INCOME
            $total_pelanggan_premium    = ClassRequest::where('premium', true)->get();
            $income_class               = ClassRequest::whereIn('class_id', $total_class_pelanggan_premium)
                                            ->where('premium', true)->get();
            $withdraw                   = WithdrawModel::where('user_id', auth()->user()->id)
                                            ->sum('withdraw_total');

            // cek riwayat penarikan dana
            if(isset($withdraw)){
                $total_withdraw = $withdraw;
            }else{
                $total_withdraw = 0;
            }

            if(empty($income_class[0])){
                $data['total_income'] = 0;
            }else{
                foreach ($income_class as $k => $v) {
                    $data['income'][$k]         = ($v->getClass->discount ? (($v->getClass->discount/100) * $v->getClass->price) : ($v->getClass->price));
                    $data['is_discount'][$k]    = $v->getClass->discount;

                }
                $all_income             = array_sum($data['income']);
                $sistem                 = (10/100) * $all_income;
                $data['total_income']   = ($all_income - $sistem - $total_withdraw - $is_redeem);
            }

            // TOTAL MATERI
            $user_class = ClassMenu::where('add_by', $id)->pluck('class_id');
            if(!empty($user_class)){
                $arr_id_materi = view_stream::whereIn('class_id', $user_class)->pluck('id');
                $rate = ReviewClassModel::whereIn('class_id', $user_class)->get()->avg('rating');
                $total_materi = view_stream::whereIn('class_id', $user_class)->get()->count();
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
            if(empty($skill)){
                $data['skill_list'] = null;
            }else{
                $data['skill_list'] = json_decode($skill->skill);
            }

            // dd($data);
        }
        return $data;
    }
    // PROFILE DETAIL
    public function profileDetail($id){
      $data = array();
      $user = User::where('id', $id)->whereNotNull('email_verified_at')->first();

      // dd($user);
      if($user == null){
        return view('auth.verify');
      }
      $data['name']   = $user->name;
      if(isset($user->userData)){
          $data['signature_url']  = $user->userData->signature_url;
      }
    //   dd($data);

      $channel_cek = DB::table('chanel')->where('id_user', $id)->first();
      $profile = self::userData(auth()->user()->id);
      return view('backend.user.user_profile', compact('profile', 'channel_cek'), [
        'data' => $data
      ]);
    }

    // LIST USER
    public function userList(){
      $users = User::orderBy('created_at', 'desc')->get();

      $id_user = auth()->user()->id;
      $channel_cek = DB::table('chanel')->where('id_user', $id_user)->first();
      $profile = self::userData(auth()->user()->id);
      return view('backend.user.list', compact('users', 'profile', 'channel_cek'));
    }

    // VERIFIKASI EMAIL
    public function profileVerified(Request $request){
      $user = User::where('id', auth()->user()->id)->first();
      if($request->email == $user->email){
        $kode = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 10);
        // dd($kode);
        $obj = new \stdClass();
        $obj->id = auth()->user()->id;
        $obj->sender = "Jarwonozt";
        $obj->name = $user->name;
        $obj->code = $kode;
        // dd('halo');
        Mail::to($request->email)->send(New Confirm($obj));
        return view('backend.user.code_verified', compact('kode'));
      }else{
        return back()->with('msg', 'Email salah atau belum terdaftar');
      }
    }

    // KODE VERIFIED
    public function codeVerified(Request $request){
      $a = $request->code_a;
      $b = $request->code_b;
      // dd($a.'-'.$b);
      if($b == $a){
        User::find(auth()->user()->id)->update([
          'verified' => "yes"
        ]);
        if(auth()->user()->role == "admin" || auth()->user()->role == "teacher"){
          return redirect('/dashboard/profile/'.auth()->user()->id.'')->with('msg', 'Verifikasi berhasil');
        }else{
          return redirect('/learning/profile/index/'.auth()->user()->id.'')->with('msg', 'Verifikasi berhasil');
        }
      }else{
        dd('salah');
      }
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
        if(auth()->user()->role == 'admin'){
            $rows = ClassRequest::where('status', 'p')->orderBy('created_at', 'desc')->paginate(100);
        }else if(auth()->user()->role == 'teacher'){
            $my_class = ClassMenu::where('add_by', auth()->user()->id)->pluck('class_id');

            $rows = ClassRequest::where('status', 'p')->whereIn('class_id', $my_class)->orderBy('created_at', 'desc')->paginate(100);
        }
        if(empty($rows[0])){
            $rows = false;
        }
        // $history = ClassHistory::where()
        // dd($rows);
        $channel_cek = self::channelCek();
        $profile = self::userData(auth()->user()->id);
        return view('backend.premium_confirm', compact('rows', 'channel_cek', 'profile'));
    }

    // SKILL RESET
    public function skillReset(){
        SkillModel::where('user_id', auth()->user()->id)->delete();
        return back()->with('msg', 'Skill berhasil direset');
    }

    // SKILL SAVE
    public function skillSave(Request $request){
        // dd($request);
        $skill = $request->fields;
        $nilai = $request->nilai;
        // dd(count($nilai));
        for($i = 0; $i < count($nilai); $i++){
            if($nilai[$i] > 100){
                return redirect('/dashboard/profile/'.auth()->user()->id)->with('error', 'Nilai skill tidak boleh lebih dari 100');
            }
        }
        $key = array([
            'name' => $skill,
            'value' => $nilai,
        ]);
        // $group = array_combine($skill, $nilai);

        $json_skill = json_encode($key);

        $check = SkillModel::where('user_id', auth()->user()->id)->first();
        if(empty($check)){
            // dd('kosong');
            $save_skill = new SkillModel();
            $save_skill->user_id = auth()->user()->id;
            $save_skill->skill = $json_skill;
            $save_skill->save();
        }else{
            $result = json_decode($check->skill);
            $res = $result[0];
            $arr = array([
                'name' => $res->name,
                'value' => $res->value,
            ]);
            $m_skill = array_merge($arr[0]['name'], $key[0]['name']);
            $m_value = array_merge($arr[0]['value'], $key[0]['value']);

            $data = array([
                'name' => $m_skill,
                'value' => $m_value,
            ]);

            $update_skill = json_encode($data);
            // dd($update_skill);
            SkillModel::where('user_id', auth()->user()->id)->update([
                'skill' => $update_skill,
                'updated_at' => Carbon::now('Asia/Jakarta'),
            ]);
            // dd($data);

        }


        return redirect('/dashboard/profile/'.auth()->user()->id)->with('msg', 'Skill updated successfully');

    }

    // DELETE REVIEW
    public function reviewDelete($id){
        $data = array();
        $row = ClassHistory::where('id', $id)->first();

        if($row->review == null){
            $data['old_review'] = $row->old_review;
        }else{
            $data['old_review'] = $row->review;
        }

        $data['slug'] = $row->getMateri->slug;
        // dd($data);


        $update = ClassHistory::where('id', $id)->update([
            'old_review' => $data['old_review']
        ]);

        if($update){
            $replace = ClassHistory::where('id', $id)->update([
                'review' => null,
            ]);
        }

        return redirect('/learning/materi/'.$data['slug'])->with('delete', 'Data berhasil disembunyikan');
    }

    // SHOW REVIEW
    public function showReview($id){
        $data = array();
        $row = ClassHistory::where('id', $id)->first();

        $data['old_review'] = $row->old_review;
        $data['slug'] = $row->getMateri->slug;
        // dd($data);


        $update = ClassHistory::where('id', $id)->update([
            'review' => $data['old_review']
        ]);

        if($update){
            $replace = ClassHistory::where('id', $id)->update([
                'old_review' => null,
            ]);
        }

    return redirect('/learning/materi/'.$data['slug'])->with('success', 'Data berhasil ditampilkan');
    }

    public static function CropImage($path, $name){
        $dateTime       = date('Y-m-d H:i:s');
        $updatedDateFormat =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('mdYHis');

        // Create an image from given image
        $im = imagecreatefrompng('home-images/kelas/'.$path);

        // find the size of image
        $size = min(imagesx($im), imagesy($im));
        $w = imagesx($im);
        $h = imagesy($im);

        if($w == 400 && $h == 400){
            $simpan_name = $updatedDateFormat.auth()->user()->id.$name.'.png';
            $simpan = 'home-images/kelas/thumbnail/'.$updatedDateFormat.auth()->user()->id.$name.'.png';
            imagepng($im, $simpan);
            imagedestroy($im);
            return ['file_name' => $simpan_name];
        }else{
            // Set the crop image size
            if ($w < $h){
                $im2 = imagecrop($im, array(
                    "x" => 0,
                    "y" => ($w - $h) / 2,
                    "width" => 400,
                    "height" => 400
                ));
            } else if ($h < $w){
                $im2 = imagecrop($im, array(
                    "x" => ($w - $h) / 2,
                    "y" => 0,
                    "width" => 400,
                    "height" => 400
                ));
            } else if ($h == $w){
                $im2 = imagecrop($im, array(
                    "x" => ($w - $h) / 2,
                    "y" => 0,
                    "width" => 400,
                    "height" => 400
                ));
            }
            // dd($im2);
            $simpan_name = $updatedDateFormat.auth()->user()->id.$name.'.png';
            $simpan = 'home-images/kelas/thumbnail/'.$updatedDateFormat.auth()->user()->id.$name.'.png';
            if ($im2 !== FALSE) {
                // header("Content-type: image/png");
                imagepng($im2, $simpan);
                imagedestroy($im2);
            }
            imagedestroy($im);
            return ['file_name' => $simpan_name];
        }
    }

    public static function topContent(){
        $user_arr       = User::whereNotNull('email_verified_at')->pluck('id');
        $class_arr      = ClassMenu::whereIn('add_by', $user_arr)->pluck('class_id');
        $content_rank   = view_stream::whereIn('class_id', $class_arr)
                            ->select('class_id', DB::raw('count(*) as total'))
                            ->groupBy('class_id')
                            ->get();

        $result         = json_decode($content_rank, JSON_PRETTY_PRINT);
        $json           = array('data' => $result);

        foreach ($json['data'] as $k => $v) {
            $data['rank'][$k]['total'] = $v['total'];
        }

        $top_content = max($data['rank']);

        return [ 'data' => $top_content ];
    }

    public static function DataClass($id, $limit){
        $data = array();
        $rows = '';

        if(empty($id)){
            $class = ClassMenu::orderBy('created_at', 'desc')->paginate($limit);
        }else{
            $class = ClassMenu::where('class_id', $id)->first();
            $data['class']['id'] = $id ;
            $data['class']['title'] = strtoupper($class->name);
            $data['class']['slug'] = $class->slug;
            $data['class']['is_premium'] = $class->premium;

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
            if(is_file(public_path('/img/user/'.$class->getUser->photo))){
                $data['class']['author_image'] = 'img/user/'.$class->getUser->photo;
            }else{
                $data['class']['author_image'] = 'img/user/s7.png';
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
        }

        return $data;
    }

    public static function DataContent($cid, $limit){
        $data = array();
        // $class_id = ClassMenu::where('class_id', $uid)->pluck('class_id');
        // $ch = chanel::where('id_user', auth()->user()->id)->first();
        if(empty($cid)){
            $content = view_stream::orderBy('created_at','desc')->paginate($limit);
            foreach ($content as $k => $v) {
                $data['content'][$k]['id'] = $v->id;
                $data['content'][$k]['title'] = $v->judul;
                $data['content'][$k]['status'] = $v->status;
                $data['content'][$k]['url'] = $v->judul;
                $data['content'][$k]['is_premium'] = $v->premium;
                $data['content'][$k]['created_at'] = $v->created_at;
            }
        }else{
            $content = view_stream::where('class_id', $cid)->orderBy('created_at','desc')->paginate($limit);
            foreach ($content as $k => $v) {
                $data['content'][$k]['id'] = $v->id;
                $data['content'][$k]['title'] = $v->judul;
                $data['content'][$k]['status'] = $v->status;
                $data['content'][$k]['url'] = $v->link;
                $data['content'][$k]['is_premium'] = $v->premium;
                $data['content'][$k]['created_at'] = $v->created_at;
            }
        }

        return $data;
    }

    public function action(Request $request){
        dd($request);
        switch($request->tipe_aksi){
            case 'p':
                view_stream::whereIn('id', $request->input('id'))->update(['status'=>'p']);

                return redirect()->back()->with('success','Data sudah di Publish !!!');
                break;
            case 'h':
                view_stream::whereIn('id', $request->input('id'))->update(['status'=>'h']);

                return redirect()->back()->with('warning','Data sudah di Hidden !!!');
                break;
            case 'd':
                $oldData = PostDinamicContent::whereIn('post_id', $request->input('id'))->get();
                $imgArray = array();
                if($oldData){
                    foreach($oldData as $v){
                        if($v['picture']){
                            $imgArray[] = $v['picture'];
                        }
                    }
                }
                PostDinamic::whereIn('post_id', $request->input('id'))->delete();
                // dd(config('app.POST_MID'));
                // if (is_file(public_path(config('app.POST_MID').$gambar_old))) {
                //     unlink(public_path($folder_second.$gambar_old));
                // }

                UserPoint::where('modul','post')->whereIn('id_post',$request->input('id'))->delete();
                foreach($request->input('id') as $k=>$v) {
                    $row_parent = PostDinamic::find($v);
                    $kategori = $row_parent->category_id;
                    $lang = session('lang');

                }
                return redirect()->back()->with('danger','Data sudah di Delete !!!');
                break;
        }
    }

    public function logout(){
      auth()->logout;
      return redirect()->route('/');
    }

}
