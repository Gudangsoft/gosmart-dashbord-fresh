<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\chanel;
use App\view_stream;
use Auth;
use File;

class ListchanelController extends Controller
{
  public function chanel()
  {
    $view_stream = DB::table('view_stream')->join('chanel','chanel.id','=','view_stream.chanel_id')->orderBy('view_stream.created_at', 'desc')->get();
    $chanel = DB::table('chanel')->get();
    return view('admin.chanel-list',compact('chanel'));
  }


  public function chanelview()
  {
    $view_stream = DB::table('view_stream')->join('chanel','chanel.id','=','view_stream.chanel_id')->orderBy('view_stream.created_at', 'desc')->get();
    $chanel = DB::table('chanel')->get();
    return view('chanel',compact('chanel'));
  }

  public function video($id)
  {
    $id = (int)$id;
    $idchanel = DB::table('chanel')->where('id',$id)->first();
    $chanel = DB::table('chanel')->where('id',$id)->get();
    $idchanel = $idchanel->id;

    $view_stream = DB::table('view_stream')->where('chanel_id',$idchanel)->orderBy('created_at', 'desc')->get();
    return view('video_chanel',compact('view_stream','chanel'));
  }
  public function data($id)
  {
    $id = (int)$id;
    $idchanel = DB::table('chanel')->where('id',$id)->first();
    $chanel = DB::table('chanel')->where('id',$id)->get();
    $idchanel = $idchanel->id;

    $view_stream = DB::table('view_stream')->where('chanel_id',$idchanel)->orderBy('created_at', 'desc')->get();
    return view('video_chanel',compact('view_stream','chanel'));
  }

}
