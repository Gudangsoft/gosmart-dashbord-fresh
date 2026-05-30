<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;

class MasterAdminController extends Controller
{
  public function __construct()
      {
          $this->middleware(['auth','admin']);
      }
  public function dataupload()
  {
  $view_stream = DB::table('view_stream')->orderBy('created_at', 'desc')->get();
  return view('master.data',compact('view_stream'));
  }

  public function destroy($id)
  {
    $stream = DB::table('view_stream')->where('id',$id)->first();

    {
      $gambar= DB::table('view_stream')->where('id','=',$id)->value('gambar');
      File::delete('home-images/'.$gambar);
      $view_stream = DB::table('view_stream')->where('id','=',$id)->delete();
    }
    return back()->with('sukses','Data Delete Success');
  }

  public function user()
  {
    $user = DB::table('users')->get();
    return view('master.user',compact('user'));
  }

  public function busek($id)
  {
    $user = DB::table('users')->where('id',$id)->first();
    $user = DB::table('users')->where('id','=',$id)->delete();
    return back()->with('sukses','Data Delete Success');
  }

  public function chanel()
  {
    $view_stream = DB::table('view_stream')->join('chanel','chanel.id','=','view_stream.chanel_id')->get();
    $chanel = DB::table('chanel')->get();
    return view('master.daftarchanel',compact('chanel'));
  }
  public function hapus($id)
  {
      $chanels = DB::table('chanel')->where('id',$id)->first();
    {
      $chanel_img = DB::table('chanel')->where('id','=',$id)->value('chanel_img');
      File::delete('chanel-image/'.$chanel_img);
      $chanel = DB::table('chanel')->where('id','=',$id)->delete();
    }
    return back()->with('sukses','Data Delete Success');
  }




}
