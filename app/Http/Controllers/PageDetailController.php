<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ClassCategory;
use App\Models\ClassMenu;
use App\Models\ReviewClassModel;
use App\User;
use App\view_stream;
use Illuminate\Http\Request;
use DB;
use Exception;

class PageDetailController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(['auth', 'verified']);

    }

    public function index($slug){
        switch ($slug) {
            case 'recomended':
                $data['class'] = self::recomended()['data'];
                $data['page'] = self::recomended()['page'];
                $data['meta']['title'] = ucfirst($slug);
                break;
            case 'popular':
                $data['class'] = self::page($slug)['data'];
                $data['page'] = self::page($slug)['page'];
                $data['meta']['title'] = ucfirst($slug);
                break;
            case 'free':
                $data['class'] = self::page($slug)['data'];
                $data['page'] = self::page($slug)['page'];
                $data['meta']['title'] = ucfirst($slug);
                break;
            default:
                return redirect('/learning');
                break;
        }

        $data['profile']        = isset(auth()->user()->id) ? LearningController::profile() : '';
        $data['data']           = Advertisement::AdvText();
        $data['meta']           = DetailController::metaData($data['meta']['title'], null, null, null, null);
        $data['categories']         = DetailController::Categories(6);
        $data['categories_sidebar'] = DetailController::Categories(20);
        $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->count();
        // dd($data);

        return view('member.index', compact('data'));
    }

    public function Categories($slug){
        try {
            $category   = ClassCategory::where('slug', $slug)->first();
            $rows       = ClassMenu::where('category_id', $category->id)->paginate(12);

            if(isset($rows)){
                foreach ($rows as $k => $v) {
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

            $data['keyword'] = $slug;
            $data['page'] = $rows;

            // META DATA
            $data['meta']               = DetailController::metaData($category->title, null, null, null, 'category/'.$category->slug);
            $data['profile']            = isset(auth()->user()->id) ? LearningController::profile() : '';
            $data['data']               = Advertisement::AdvText();
            $data['class_recomended']   = PageDetailController::recomended()['data'];
            $data['page_recomended']    = PageDetailController::recomended()['page'];
            $data['categories']         = DetailController::Categories(6);
            $data['categories_sidebar'] = DetailController::Categories(20);
            $data['cart_count']         = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();


            // dd($data);
            return view('member.class.categories', compact('data'));

        } catch (Exception $e) {
            return view('errors.404');
        }


    }



    public static function recomended(){
        $rows = ReviewClassModel::select(DB::raw('class_id, max(rating) as rating'))
                ->where('status', 'p')
                ->orderBy('rating', 'desc')
                ->groupBy('class_id')
                ->paginate(8);

        $data = array();
        foreach ($rows as $k => $v) {
            $data[$k]['class']              = ClassMenu::where('class_id', $v->class_id)->value('category_id');
            $data[$k]['id']                 = $v->class_id;
            $data[$k]['category_title']     = ClassCategory::where('id', $data[$k]['class'])->value('title') ?ClassCategory::where('id', $data[$k]['class'])->value('title') : '';
            $data[$k]['category_slug']      = ClassCategory::where('id', $data[$k]['class'])->value('slug') ? ClassCategory::where('id', $data[$k]['class'])->value('title') : '';
            $data[$k]['name']               = $v->getClass->name;
            $data[$k]['image']              = asset('/home-images/kelas/thumbnail').'/'.$v->getClass->image;

            if($v->price == 0){
                $data[$k]['price'] = 'GRATIS';
            }else{
                $data[$k]['price'] = 'Rp '.number_format($v->price,0,',','.');
            }

            $data[$k]['total_discount']    = $v->getClass->discount;
            $data[$k]['discount']          = isset($v->getClass->discount) ? ('Rp '.number_format(($v->getClass->price - ($v->getClass->discount/100*$v->getClass->price)),0,',','.')) : '0';
            $data[$k]['price_default']     = isset($v->discount) ? ($v->price - $v->discount/100*$v->price) : $v->price;
            $data[$k]['url']        = '/class/'.$v->getClass->slug;;
            $data[$k]['premium']    = $v->getClass->premium;
            $data[$k]['total_materi'] = view_stream::where('class_id', $v->class_id)->count();;
            $author = User::where('id', $v->getClass->add_by)->first();
            $data[$k]['author']     = ucfirst($author->name);
            if(is_file(public_path('/img/user/avatar/'.$author->photo))){
                $data[$k]['author_image'] = '/img/user/avatar/'.$author->photo;
            }else{
                $data[$k]['author_image'] = '/img/user/s7.png';
            }
            // $data[$k]['author_image'] = '/img/user/'.$author->photo;
            $data[$k]['author_url'] = '/mentor/'.$author->name;
            $data[$k]['star']       = number_format((int)$v->rating, 1, '.', '');

            $row_review_class   = ReviewClassModel::where('class_id', $v->class_id);
            $review_class       = ReviewClassModel::where('class_id', $v->class_id)->get();
            $rating             = $review_class->avg('rating');
            if($rating == null){
                $rating = 5;
            }
            $count_review       = $review_class->count();

        }
        // dd($data);
        return ['data' => $data, 'page' => $rows];
    }

    public static function page($page_name){
        if($page_name == 'popular'){
            $rows = ClassMenu::where('status', 'p')->orderBy('visitor', 'desc')->paginate(8);
        }else if($page_name == 'free'){
            $rows = ClassMenu::where('status', 'p')->where('premium', false)
                ->orderBy('created_at', 'desc')
                ->paginate(8);
        }

        $data = array();
        foreach ($rows as $k => $v) {
            $data[$k]['id']             = $v->class_id;
            $data[$k]['category_title']    = isset($v->getCategory) ? $v->getCategory->title : '';
            $data[$k]['category_slug']     = isset($v->getCategory) ? $v->getCategory->slug : '';
            $data[$k]['name']           = $v->name;
            $data[$k]['image']          = asset('/home-images/kelas/thumbnail').'/'.$v->image;

            if($v->price == 0){
                $data[$k]['price'] = 'GRATIS';
            }else{
                $data[$k]['price'] = 'Rp '.number_format($v->price,0,',','.');
            }

            $data[$k]['total_discount']    = $v->discount;
            $data[$k]['discount']          = isset($v->discount) ? ('Rp '.number_format(($v->price - ($v->discount/100*$v->price)),0,',','.')) : '0';
            $data[$k]['price_default']     = isset($v->discount) ? ($v->price - $v->discount/100*$v->price) : $v->price;
            $data[$k]['url']            = '/class/'.$v->slug;
            $data[$k]['premium']        = $v->premium;
            $data[$k]['total_materi']   = view_stream::where('class_id', $v->class_id)->count();;
            $data[$k]['author']         = ucfirst($v->getUser->name);
            if(is_file(public_path('/img/user/avatar/'.$v->getUser->photo))){
                $data[$k]['author_image'] = '/img/user/avatar/'.$v->getUser->photo;
            }else{
                $data[$k]['author_image'] = '/img/user/s7.png';
            }
            $data[$k]['author_url']     = '/mentor/'.$v->getUser->name;
            $data[$k]['star']           = (int)$v->rating;

            $review_class               = ReviewClassModel::where('class_id', $v->class_id)->get();
            $rating                     = $review_class->avg('rating');
            if($rating == null){
                $rating = 5;
            }

            $data[$k]['star']           = number_format($rating, 1, '.', '');

        }
        return ['data' => $data, 'page' => $rows];
    }

}
