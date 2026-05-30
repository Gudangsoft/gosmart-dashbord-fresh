<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chanel;
use App\view_stream;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LearningController;
use App\Models\Cart;
use App\Models\ClassCategory;
use App\Models\ClassMenu;
use App\Models\ReviewClassModel;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $cari = $request->search;

        $class = ClassMenu::where('name', 'like',"%".$cari."%")
                ->orWhere('description','like',"%".$cari."%")
                ->where('status', 'p')
                ->orderBy('created_at','desc')
                ->paginate(8);

        if(isset($class)){
            foreach ($class as $k => $v) {
                $data['class'][$k]['id'] = $v->class_id;
                $data['class'][$k]['category_title']    = isset($v->getCategory) ? $v->getCategory->title : '';
                $data['class'][$k]['category_slug']     = isset($v->getCategory) ? $v->getCategory->slug : '';
                $data['class'][$k]['name'] = $v->name;
                $data['class'][$k]['image'] = asset('/home-images/kelas/thumbnail').'/'.$v->image;
                $data['class'][$k]['price'] = $v->price;
                $data['class'][$k]['mentor'] = $v->getUser->name;
                $data['class'][$k]['url'] = '/class/'.$v->slug;
                $data['class'][$k]['premium'] = $v->premium;
                $data['class'][$k]['author'] = $v->getUser->name;

                if(is_file(public_path('/img/user/avatar/'.$v->getUser->photo))){
                    $data['class'][$k]['author_image'] = '/img/user/avatar/'.$v->getUser->photo;
                }else{
                    $data['class'][$k]['author_image'] = '/img/user/s7.png';
                }

                $data['class'][$k]['author_url'] = '/mentor/'.$v->getUSer->name;
                $data['class'][$k]['total_materi'] = view_stream::where('class_id', $v->class_id)->count();

                $row_review_class   = ReviewClassModel::where('class_id', $v->class_id);
                $review_class       = ReviewClassModel::where('class_id', $v->class_id)->get();
                $rating             = $review_class->avg('rating');
                if($rating == null){
                    $rating = 0;
                }
                $count_review       = $review_class->count();
                $data['class'][$k]['star'] = number_format($rating, 1, '.', '');

                $data['review'] = [
                    'rating' => $rating,
                    'count_review' => $count_review,
                ];
            }
        }

        $data['keyword'] = $cari;
        $data['page'] = $class;

        // META DATA
        $data['meta']               = DetailController::metaData($cari, null, null, null, 'tags/'.$cari);
        $data['profile']            = isset(auth()->user()->id) ? LearningController::profile() : '';

        $data['data']               = Advertisement::AdvText();
        $data['class_recomended']   = PageDetailController::recomended()['data'];
        $data['page_recomended']    = PageDetailController::recomended()['page'];
        $data['categories']         = DetailController::Categories(6);
        $data['categories_sidebar'] = DetailController::Categories(20);
        $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();

        // dd($data);
        return view('member.result_search', compact('data'));
    }

    public function tags($slug)
    {
        $cari = $slug;
        $view_stream = view_stream::where('kategori','like',"%".$cari."%")->orWhere('judul','like',"%".$cari."%")->orWhere('keterangan','like',"%".$cari."%")
        ->orWhere('tags','like',"%".$cari."%")->paginate(8);

        $profile = DashboardController::userData(auth()->user()->id);
        $channel_cek = DashboardController::channelCek();

        return view('member.result_search',compact('view_stream', 'cari', 'channel_cek', 'profile'), ['page' => $view_stream]);
    }

    public function classFilter(Request $request)
    {
        // dd($request);
        $data = array();

        $id = auth()->user()->id;
        $class_id = $request->class_filter;

        $content = view_stream::where('class_id', $class_id)->orderBy('created_at','desc')->paginate(20);
        // $ch = chanel::where('id_user', auth()->user()->id)->first();
        if($id == 0){
            $view_stream = null;
        }else{
            $view_stream = $content;
        }

        $profile = DashboardController::userData(auth()->user()->id);
        $channel_cek = DashboardController::channelCek();

        $data['class_filter'] = ClassMenu::where('add_by', $id)->get();
            foreach ($data['class_filter'] as $k => $v) {
                $data['class'][$k]['class_id'] = $v->class_id;
                $data['class'][$k]['class_name'] = $v->name;
            }

        return view('backend.user_materi',compact('data', 'view_stream', 'channel_cek', 'profile'));
    }

}
