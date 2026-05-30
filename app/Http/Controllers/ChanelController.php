<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\chanel;
use App\Models\ChannelData;
use App\Models\User;
use App\view_stream;
use App\Ua\MobileDetect;
use File;

class ChanelController extends Controller
{
  public function __construct()
      {
          $this->middleware('auth');
      }

    // save to data channel
    public function addDataChannel($id){
        $materi = view_stream::where('id', $id)->first();
        // dd($materi);
        $simpan = new ChannelData();
        $simpan->user_id = auth()->user()->id;
        $simpan->materi_id = $id;
        $simpan->channel_id = $materi->chanel_id;
        $simpan->class_id = $materi->class_id;
        $simpan->save();

        return redirect('/dashboard/channel_detail/'.auth()->user()->id)->with('msg', 'Materi berhasil ditambah');
    }

    public function channelDetail($id){
        $channel = chanel::where('id_user', $id)->first();

        $class_menu = view_stream::where('chanel_id', $channel->id)->get();
        $jumlah = view_stream::where('chanel_id', $channel->id)->pluck('class_id');
        $total_kategori = DB::table('view_stream')->join('chanel','chanel.id','=','view_stream.chanel_id')->where('chanel_id', $channel->id)->pluck('class_id');
        $jumlah_data = view_stream::join('chanel','chanel.id','=','view_stream.chanel_id')->where('chanel_id', $channel->id)->select('class_id', DB::raw('count(*) as jumlah'))->groupBy('class_id')->get();
        // for($i = 0; $i <= count($jumlah_data); $i++){
        //   $jml = $jumlah_data[$i]->jumlah;
        // }
        // dd($class_menu);
        foreach ($class_menu as $key => $v) {
            $data['class_name'] = $v->getClass->name;
            $data['jumlah'] = $v->class_id;
        }

        // dd($jumlah_data);

        $channel = DB::table('chanel')->where('id_user', $id)->get();
        foreach ($channel as $k => $v){} {
            $data['id'] = $v->id;
            $data['name'] = $v->nama_chanel;
            $data['link'] = $v->link_chanel;
            $data['img'] = $v->chanel_img;
        }
        // dd($data);

        $data['row'] = DetailController::DataChannel(10);

        $profile = DashboardController::userData(auth()->user()->id);
        $channel_cek = DashboardController::channelCek();

        return view('backend.channels.index', compact('channel', 'channel_cek', 'jumlah_data', 'profile', 'data'));
    }

    public function view()
    {
        // $chanel = DB::table('chanel')->get();

        $id = auth()->user()->id;
        $chanel = DB::table('chanel')->where('id_user','=',$id)->count();
        if ($chanel > 0) {
        return redirect('admin');

        }
        $view = DB::table('view_stream')->where('id','=',1)->first();
        return view('chanelregist',compact('view'));
    }

    public function addchanel(Request $req)
    {
        // dd($req);

        $id = auth()->user()->id;
        $fullname = DB::table('users')->where('id','=',$id)->value('name');
        // dd($fullname);

        $nama_lengkap   = $fullname;
        $nama_chanel    = $req->nama_chanel;
        $link_chanel    = $req->link_chanel;
        $deskripsi      = $req->deskripsi;
        $chanel_img     = "";

        // dd($chanel_img);
        if($req->id == null){

            $rules = [
                // 'nama_lengkap' => 'required',
                'nama_chanel' => 'required|unique:chanel',
                'link_chanel' => 'required|unique:chanel',
                'deskripsi' => 'required',
                'chanel_img' => 'mimes:jpeg,png|max:4000|required',

            ];
            $message = [
                // 'nama_lengkap.required' => 'Nama tidak boleh kosong',
                'nama_chanel.required' => 'Nama chanel tidak boleh ksosong',
                'link_chanel.required' => 'Link chanel tidak boleh kosong',
                'chanel_img.mimes' => 'ekstensi gambar harus jpg atau png',
                'chanel_img.max' => 'Maksimal ukuran gambar harus 4mb',
            ];

            $this->validate($req,$rules,$message);


            $chanel_img     = "view_stream"."-".$req->chanel_img->getClientOriginalname();
            $save           = $req->file('chanel_img')->move('chanel-image/',$chanel_img);
            // $chanel_img = "view_stream"."-".$req->chanel_img->getClientOriginalname();
            // $save = $req->file('chanel_img')->move('chanel-images/',$chanel_img);
            $insert_chanel = DB::table('chanel')->insert([
                'nama_lengkap' => $nama_lengkap,
                'nama_chanel' => $nama_chanel,
                'link_chanel' => $link_chanel,
                'deskripsi' => $deskripsi,
                'chanel_img' => $chanel_img,
                'id_user' => $id,
            ]);
        }else{
            if(empty($req->chanel_img)){
                $chanel_img     = DB::table('chanel')->where('id','=',$req->id)->value('chanel_img');
            }else{
                $chanel_img     = "view_stream"."-".$req->chanel_img->getClientOriginalname();
                $save           = $req->file('chanel_img')->move('chanel-image/',$chanel_img);
            }


            // DELETE GAMBAR AWAL ?

            chanel::where('id', $req->id)->update([
                'nama_chanel' => $nama_chanel,
                'link_chanel' => $link_chanel,
                'deskripsi' => $deskripsi,
                'chanel_img' => $chanel_img,
            ]);
        }

        return redirect('/dashboard/channel_detail/'.$id)->with('success','data berhasil ditambah');
    }

    public function addPage(){
        return view('backend.channels.add');
    }

     //DELETE Content
     public function deleteContent($id){
        // dd($id);
        ChannelData::where('id','=',$id)->delete();

        return back()->with('msg','Data Delete Success');
      }

}
