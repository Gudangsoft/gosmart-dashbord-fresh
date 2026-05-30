<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Advertisement;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\LearningController;
use App\Models\Cart;
use App\Models\ClassCategory;
use App\Models\Creation;
use App\ResizeImage;
use App\User;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CreationController extends Controller
{
    public function index(){
        $data = array();

        $data['mentor'] = DetailController::users('teacher', 8)['data'];
        $data['page']   = DetailController::users('teacher', 8)['page'];

        $data['data']           = Advertisement::AdvText();
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        $data['meta']           = DetailController::metaData("Portofolio Member", "portfolio, member, karya", "Kumpulah hasil karya member yang bisa menjadi portofolio mereka", null, null);
        $data['creations']      = Creation::orderByDesc('id')->paginate(12);
        $data['creations_count']    = Creation::all()->count();

        // dd($data);
        return view('member.creation.index', ['data' => $data]);
    }

    public function edit($id){
        $data = array();
        $row = User::where('id', auth()->user()->id)->first();
        $data['profile']            = LearningController::profile();
        $data['data']               = DetailController::dataProfile($row->id);
        $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();
        $data['cart_data']          = DetailController::CartData();

        $data['url_overview']       = '/learning/profile/'.$row->name;
        $data['url_history']        = '/learning/tab-menu/history';
        $data['url_edit']           = '/learning/tab-menu/edit-profile';
        $data['url_payment']        = '/learning/tab-menu/payment';
        $data['url_certificate']    = '/learning/tab-menu/certificate';
        $data['url_report']         = '/learning/tab-menu/report';
        $data['url_creation']       = '/learning/tab-menu/creation';
        $data['url_cart']           = '/learning/tab-menu/cart';

        $data['creation']           = Creation::find($id);
        // dd($data);
        return view('member.profile.data.creations.edit', [ 'data' => $data]);
    }

    public function create(){
        $data = array();
        $row = User::where('id', auth()->user()->id)->first();
        $data['profile']            = LearningController::profile();
        $data['data']               = DetailController::dataProfile($row->id);
        $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();
        $data['cart_data']          = DetailController::CartData();

        $data['url_overview']       = '/learning/profile/'.$row->name;
        $data['url_history']        = '/learning/tab-menu/history';
        $data['url_edit']           = '/learning/tab-menu/edit-profile';
        $data['url_payment']        = '/learning/tab-menu/payment';
        $data['url_certificate']    = '/learning/tab-menu/certificate';
        $data['url_report']         = '/learning/tab-menu/report';
        $data['url_creation']       = '/learning/tab-menu/creation';
        $data['url_cart']           = '/learning/tab-menu/cart';
        
        return view('member.profile.data.creations.create', [ 'data' => $data]);
    }

    public function store(Request $request){
        $folder_first   = 'public/home-images/creation/';
        $folder_second  = 'public/home-images/creation/thumb/';

        // $format = $request->image->getClientOriginalExtension();
        // if($format == 'png' || $format == 'jpg' || $format == 'jpeg'){
        //     $photo = "creation".$request->name."-".$request->image->getClientOriginalname();
        //     $save_image = $request->file('image')->move($folder_first,$photo);
        //     $image_crop_name = ResizeImage::resizeImage($photo, $request->name, $folder_first, $folder_second)['file_name'];
        // }

        try {

            $save = new Creation();
            $save->name = $request->name;
            $save->url = $request->url;
            // $save->image = $image_crop_name;
            $save->description = $request->description;
            $save->status = 1;
            $save->created_by = auth()->user()->id;
            $save->save();

            return redirect('/learning/tab-menu/creation')->with('msg', 'Data karyamu berhasil ditambahkan');
        } catch (Exception $error) {
            return back()->with('msg', $error->getMessage());
        }
    }

    public function update(Request $request){
        $folder_first   = 'home-images/creation/';
        $folder_second  = 'home-images/creation/thumb/';

        // $photo_old = Creation::find($request->id)->first()->foto;
        // if($request->image == null){
        //     $photo = $photo_old;
        // }else{
        //     $format = $request->image->getClientOriginalExtension();
        //     if($format == 'png' || $format == 'jpg' || $format == 'jpeg'){
        //         if(is_file(public_path($folder_second.$photo_old))){
        //             unlink(public_path($folder_second.$photo_old));
        //             $photo = "creation".$request->name."-".$request->image->getClientOriginalname();
        //             $save_image = $request->file('image')->move($folder_first,$photo);
        //             $image_crop_name = ResizeImage::resizeImage($photo, $request->name, $folder_first, $folder_second)['file_name'];

        //         }else{
        //             $photo = "creation".$request->name."-".$request->image->getClientOriginalname();
        //             $save_image = $request->file('image')->move($folder_first,$photo);
        //             $image_crop_name = ResizeImage::resizeImage($photo, $request->name, $folder_first, $folder_second)['file_name'];
        //         }
        //     }else{
        //         return back()->with('error', 'Format foto tidak didukung');
        //         // dd($format);
        //     }
        // }

        try {

            $save = Creation::findOrFail($request->id);
            $save->name = $request->name;
            $save->url = $request->url;
            // if($request->image != null){
            //     $save->image = $image_crop_name;
            // }
            $save->description = $request->description;
            $save->status = 1;
            $save->created_by = auth()->user()->id;
            $save->save();

            return redirect('/learning/tab-menu/creation')->with('msg', 'Data karyamu berhasil ditambahkan');
        } catch (Exception $error) {
            return back()->with('msg', $error->getMessage());
        }
    }

    public function delete($id){
        Creation::find($id)->delete();
        return back()->with('delete', 'Data berhasil dihapus');
    }
}
