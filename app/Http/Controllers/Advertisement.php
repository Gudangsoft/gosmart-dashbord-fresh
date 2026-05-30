<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Models\AdvTextModel;
use Carbon\Carbon;

class Advertisement extends Controller
{

    public function Advertisement($slug){
        $data = array();
        $data['meta']['title'] = 'Advertisement';
        switch ($slug) {
            case 'text':
                $data['data'] = self::AdvText();

                $data['meta']['type'] = ucfirst($slug);
                $profile = DashboardController::userData(auth()->user()->id);
                $channel_cek = AdminController::channelCek();
                return view('backend.advertisement.form', compact('data', 'profile'));
                break;
            case 'banner':
                echo "<script>alert('coming soon..');</script>";

                // return back();
                break;

            default:
                # code...
                break;
        }
    }

    public function AdvertisementSave(Request $r){
        $data = array();
        $id = $r->id;
        $text = htmlentities($r->title);
        $url = $r->url;
        $type = strtolower($r->type);
        if($type == 'text'){
            if(empty($text) && empty($url)){
                return back()->with('error', 'Data tidak boleh kosong!');
            }else{
                if(empty($id)){
                    $t = new AdvTextModel();
                    $t->text    = $text;
                    $t->url     = $url;
                    $t->add_by  = auth()->user()->id;
                    $t->save();
                }else{
                    AdvTextModel::where('id', $id)->update([
                        'text' => $text,
                        'url' => $url,
                        'add_by' => auth()->user()->id,
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
        }else{
            #
        }

        return redirect('/dashboard/advertisement/'.$type)->with('success', 'Data berhasil diubah');
    }

    public static function AdvText(){
        $row = AdvTextModel::first();
            // dd($row);
            $data['id'] = $row->id;
            $data['text'] = $row->text;
            $data['url'] = $row->url;

        return $data;

    }

    public function infoUpdate(){

    }
}
