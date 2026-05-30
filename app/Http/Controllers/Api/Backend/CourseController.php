<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\ClassMenu;
use App\Models\Level;
use App\Models\ToolsMateri;
use App\ResizeImage;
use App\view_stream;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{

    public function index()
    {

        $courses = ClassMenu::orderByDesc('created_at')->paginate(10);

        foreach ($courses as $k=>$v) {
            $data[$k]['id']             = $v->class_id;
            $data[$k]['category']       = empty($v->category_id) ? null : $v->getCategory->title;
            $data[$k]['name']           = $v->name;
            $data[$k]['slug']           = $v->slug;
            $data[$k]['description']    = $v->description;
            $data[$k]['status']         = $v->status;
            $data[$k]['created_by']     = Str::title($v->getUser->name);
            $data[$k]['iamge']          = public_path('/home-images/kelas/thumbnail/').$v->image;
            $data[$k]['price']          = number_format($v->price);
            $data[$k]['discount']       = $v->discount;
            $data[$k]['premium']        = (int)$v->premium;
            $data[$k]['tags']           = $v->tags;
            $data[$k]['level']          = empty($v->level_id) ? null : $v->getLevel->name;
            $data[$k]['source_url']     = $v->source_url;
            $data[$k]['visitor']        = $v->visitor;
            $data[$k]['created_at']     = Carbon::parse($v->created_at)->isoFormat('dddd, D MMMM Y');

            if($v->tools_id == null){
                $toolsMateri = null;
            }else{
                $toolsMateri = ToolsMateri::whereIn('id', explode(',', $v->tools_id))->get();
                foreach ($toolsMateri as $a => $b) {
                    $data[$k]['tools'][$a]['name'] = $b->title;
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Data course',
            'data' => $data,
        ], 200);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $data           = array();
        $dateTime       = date('Y-m-d H:i:s');
        $category_id    = $request->category_id;
        $updatedDateFormat =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('mdYHis');
        $name           = $request->name;
        $slug           = Str::slug($name);
        $description    = $request->description;
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

        $plusPrecent = ((10/100)*(int)$dot_price);
        $priceNow = (int)$dot_price + (int)$plusPrecent;

        $gambar         = $request->image;
        $premium        = $request->premium;
        $tags           = $request->tags;
        $level          = $request->level;
        $tools          = $request->tools;
        $source_url     = $request->source_url;

        // if(!empty($tools)){
        //     $select_tools = implode(",", $tools);
        // }else{
        //     $select_tools = null;
        // }

        $url_materi     = $request->video_url;

        $n      = 'string|max:255|unique:class_menu';
        $img    = 'mimes:jpeg,png|max:6000|required|dimensions:min_width=400,min_height=400,max_width=3000,max_height=3000';

        $val    = [
                    'name' => $n,
                    'price' => 'max:255',
                    'image' => $img,
                ];

        $msg    = [
                    // 'name.unique' => 'Nama kelas '.$request->name.' sudah ada !',
                    'image.dimensions' => 'Resolusi gambar minimal 400x400 pixel'
                ];

        $cek = $this->validate($request, $val, $msg);

        try {
            if($cek){
                $gambarx = $updatedDateFormat.auth()->user()->id.$request->image->getClientOriginalname();
                $save = $request->file('image')->move($folder_first,$gambarx);
                $image_crop_name = ResizeImage::resizeImage($gambarx, $name, $folder_first, $folder_second)['file_name'];
            }

            $class_menu                 = new ClassMenu();
            $class_menu->category_id    = $category_id;
            $class_menu->name           = strtolower($name);
            $class_menu->slug           = $slug;
            $class_menu->description    = htmlentities($description, ENT_QUOTES);
            $class_menu->image          = $image_crop_name;
            $class_menu->premium        = $premium;
            $class_menu->tags           = $tags;
            $class_menu->level_id       = $level;
            $class_menu->tools_id       = $tools;
            $class_menu->source_url     = $source_url;
            $class_menu->status         = 'p';
            $class_menu->price          = (int)$priceNow;
            $class_menu->discount       = (int)$precent == 0 || empty((int)$precent) ? null : (int)$precent;
            $class_menu->add_by         = auth()->user()->id;
            $class_menu->save();

            $count_materi   = count($request->video_url);
            $get_class_id = ClassMenu::latest('class_id')->value('class_id');
            for($i=0; $i<$count_materi; $i++){

                $url = $request->video_url[$i];
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
                $materi->link       = $request->video_url[$i];
                $materi->slug       = $youtube_id[$i];
                $materi->premium    = $request->premium;
                $materi->class_id   = $get_class_id;
                $materi->status     = 'p';
                $materi->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Data course add successfully',
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'status' => false,
                'message' => $error->getMessage(),
            ], 400);
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data           = array();
        $dateTime       = date('Y-m-d H:i:s');
        $updatedDateFormat =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('mdYHis');
        $class_id       = $id;
        $category_id    = $request->category_id;
        $name           = $request->name;
        $slug           = Str::slug($name);
        $description    = $request->description;
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

        $gambar_old     = ClassMenu::where('class_id', $class_id)->value('image');
        $price_old      = ClassMenu::where('class_id', $class_id)->value('price');

        $plusPrecent    = $dot_price == $price_old ? 0 : ((10/100)*(int)$dot_price);
        $priceNow       = (int)$dot_price + (int)$plusPrecent;

        $gambar         = $request->image;
        $premium        = $request->premium;
        $tags           = $request->tags;
        $level          = $request->level;
        $tools          = $request->tools;
        $source_url     = $request->source_url;

        // if(!empty($tools)){
        //     $select_tools = implode(",", $tools);
        // }else{
        //     $select_tools = null;
        // }

        $img    = 'mimes:jpeg,png|max:6000|required|dimensions:min_width=400,min_height=400,max_width=3000,max_height=3000';

        $val    = [
                    'price' => 'max:255',
                    'image' => $img,
                ];

        $msg    = [
                    'image.dimensions' => 'Resolusi gambar minimal 400x400 pixel'
                ];

        $cek = $this->validate($request, $val, $msg);

        try {
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
            }

            $class_menu                 = ClassMenu::findOrFail($class_id);
            $class_menu->category_id    = $category_id;
            $class_menu->name           = strtolower($name);
            $class_menu->slug           = $slug;
            $class_menu->description    = htmlentities($description, ENT_QUOTES);
            $class_menu->image          = $image_crop_name;
            $class_menu->premium        = $premium;
            $class_menu->tags           = $tags;
            $class_menu->level_id       = $level;
            $class_menu->tools_id       = $tools;
            $class_menu->source_url     = $source_url;
            $class_menu->price          = (int)$priceNow;
            $class_menu->discount       = (int)$precent == 0 || empty((int)$precent) ? null : (int)$precent;
            $class_menu->add_by         = auth()->user()->id;
            $class_menu->save();

            return response()->json([
                'status' => true,
                'message' => 'Data course updated successfully',
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'status' => false,
                'message' => $error->getMessage(),
            ], 400);
        }
    }


    public function destroy($id)
    {
        $gambar_old     = ClassMenu::where('class_id', $id)->value('image');

        $folder_first   = 'home-images/kelas/';
        $folder_second  = 'home-images/kelas/thumbnail/';

        try {

            if(is_file(public_path($folder_second.$gambar_old)))
            {
                unlink(public_path($folder_second.$gambar_old));
            }

            // delete permanent
            $video  = view_stream::where('class_id', $id)->forceDelete();
            $course = ClassMenu::where('class_id', $id)->forceDelete();

            return response()->json([
                'status' => true,
                'message' => 'Data course deleted',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
