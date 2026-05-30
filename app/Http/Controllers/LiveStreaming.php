<?php

namespace App\Http\Controllers;

use App\Models\LiveStream;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LiveStreaming extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = array();
        $row = LiveStream::orderBy('created_at', 'desc')->get();
        if(!empty($row[0])){
            foreach ($row as $k => $v) {
                $data[$k]['id'] =  $v->id;
                $data[$k]['title'] =  $v->title;
                $data[$k]['youtube_id'] =  $v->youtube_id;
                $data[$k]['add_by'] =  $v->getUser->name;
                $data[$k]['status'] =  $v->status;
                $data[$k]['created_at'] =  $v->created_at;
            }

        }
        // dd($data);
        $profile = DashboardController::userData(auth()->user()->id);
        // $channel_cek = DashboardController::channelCek();

        return view('backend.livestream.index', compact('data', 'profile'));
    }


    public function create($id)
    {
        $data = array();
        $row = DetailController::livestreaming($id);
        // dd($row);
        if($id == 0){
            $data['id'] = '';
            $data['title'] = '';
            $data['youtube_id'] = '';
            $data['youtube_id'] = '';
        }else{
            $data['id'] = $row['row']['id'];
            $data['title'] = $row['row']['title'];
            $data['youtube_id'] = $row['row']['youtube_id'];
            // $data['add_by'] = '';
            // dd($data);

        }

        $profile = DashboardController::userData(auth()->user()->id);

        return view('backend.livestream.form', compact('data', 'profile'));
    }

    public function save(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $title = $request->title;
        $youtube_id = $request->youtube_id;

        $row = DetailController::livestreaming($id);

        if($id == null){
            $livestream = new LiveStream();
            $livestream->title = $title;
            $livestream->youtube_id = $youtube_id;
            $livestream->add_by = auth()->user()->id;
            $livestream->status = 'p';
            $livestream->save();

            return redirect('/dashboard/livestream')->with('add','');
        }else{
            LiveStream::where('id', $id)->update([
                'title' => $title,
                'youtube_id' => $youtube_id,
                'updated_at' => Carbon::now(),
            ]);

            return redirect('/dashboard/livestream')->with('sukses','');
        }

    }

    //HIDE and UNHIDE VIDEO
    public function setStatus(Request $request, $id, $s){
        // dd($s);
        if($s == 'h'){
          $update = LiveStream::where('id', $id)->where('status', $s)->update([
            'status' => 'p',
            'updated_at' => Carbon::now()
          ]);
        }else{
          $update = LiveStream::where('id', $id)->where('status', $s)->update([
            'status' => 'h',
            'updated_at' => Carbon::now()
          ]);
        }

        // $view_stream = DB::table('chanel')->where('id_user', auth()->user()->id)->first();
        return redirect('/dashboard/livestream')->with('sukses','Data berhasil di update');
    }

    public function destroy($id)
    {
        LiveStream::find($id)->delete();
        return redirect('/dashboard/livestream')->with('delete', '');
    }
}
