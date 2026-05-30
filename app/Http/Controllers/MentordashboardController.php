<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use App\view_stream;

class MentordashboardController extends Controller
{
  public function __construct()
      {
          $this->middleware(['auth','mentor']);
      }

    public function mentor(Request $req)
    {
      return view ('mentor.mentorpage');

    }


    public function create(Request $req)
    {

      $rules = [

             'link' => 'required',
             'judul' => 'required',
             'keterangan' => 'required',
             'gambar' => 'mimes:jpeg,png|max:6000|required',
             'kategori' => 'required',
          ];

          $message = [

            'link.required' => 'link harus di isi',
            'judul.required' => 'judul harus di isi',
            'keterangan.required' => 'Keterangan harus di isi',
            'gambar.mimes' => 'ekstensi gambar harus jpg atau png',
            'gambar.max' => 'Maksimal ukuran gambar harus 6mb',
            'kategori.required' => 'kategori harus di isi',

          ];
          $this->validate($req, $rules, $message);
      $id = auth()->user()->id;
      $chanel_id = DB::table('chanel')->where('id_user','=',$id)->value('id');
      $link = $req->link;
      $judul = $req->judul;
      $keterangan = $req->keterangan;
      $gambar = $req->gambar;
      $kategori = $req->kategori;
      $gambar = "view_stream"."-".$req->gambar->getClientOriginalname();
      $save = $req->file('gambar')->move('home-images/',$gambar);

      $update = DB::table('view_stream')->insert([
        'link' => $link,
        'judul' => $judul,
        'keterangan' => $keterangan,
        'gambar' => $gambar,
        'kategori' => $kategori,
        'chanel_id' => $chanel_id,

      ]);

      return redirect('/data-upload')->with('sukses','Data berhasil di update');

    }

    public function data()
    {
      $idchanel = DB::table('chanel')->where('id_user','=',auth()->user()->id)->first();
      $idchanel = $idchanel->id;
      $view_stream = DB::table('view_stream')->where('chanel_id',$idchanel)->orderBy('created_at', 'desc')->get();
      return view('admin.dataupload',compact('view_stream'));
    }

    public function edit($id)
    {
      $view_stream = DB::table('view_stream')->get();

      $view_stream = DB::table('view_stream')->where('id','=',$id)->first();
      return view('admin.editview',compact('view_stream'));
    }

    public function updateview(Request $req)
    {

      $rules = [

             'link' => 'required',
             'judul' => 'required',
             'keterangan' => 'required|max:150',
             'gambar' => 'mimes:jpeg,png|max:6000|required',
             'kategori' => 'required',
          ];

          $message = [

            'link.required' => 'link harus di isi',
            'judul.required' => 'judul harus di isi',
            'keterangan.required' => 'Keterangan harus di isi',
            'gambar.mimes' => 'ekstensi gambar harus jpg atau png',
            'gambar.max' => 'Maksimal ukuran gambar harus 6mb',
            'kategori.required' => 'kategori harus di isi',

          ];
          $this->validate($req, $rules, $message);

          $gambar= DB::table('view_stream')->where('id','=',$req->id)->value('gambar');
          File::delete('home-images/'. $gambar);

      $link = $req->link;
      $judul = $req->judul;
      $keterangan = $req->keterangan;
      $gambar = $req->gambar;
      $gambar = "view_stream"."-".$req->gambar->getClientOriginalname();
      $save = $req->file('gambar')->move('home-images/',$gambar);
      $kategori = $req->kategori;
      // $rand = rand(1,9);
      // $nama_gambar = "view_stream"."-".$rand."-".$req->gambar->getClientOriginalname();
      // $save = $req->file('gambar')->move('home-images/',$nama_gambar);
      // $kategori = $req->kategori;

      // $update = DB::table('view_stream')->insert([
        $home = DB::table('view_stream')->where('id','=',$req->id)->update([
        'link' => $link,
        'judul' => $judul,
        'keterangan' => $keterangan,
        'gambar' => $gambar,
        'kategori' => $kategori,


      ]);

      return redirect('/data-upload')->with('sukses','Data berhasil di update');

    }

    public function delete($id)
    {
      $stream = DB::table('view_stream')->where('id',$id)->first();
      $chanel = DB::table('chanel')->where('id',$stream->chanel_id)->first();
      if ($chanel->id_user==auth()->user()->id)
      {
        $gambar= DB::table('view_stream')->where('id','=',$id)->value('gambar');
        File::delete('home-images/'.$gambar);
        $view_stream = DB::table('view_stream')->where('id','=',$id)->delete();
      }
      return back()->with('sukses','Data Delete Success');
    }


}

//////33333333333333333333333333
