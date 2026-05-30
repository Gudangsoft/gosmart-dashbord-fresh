<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Advertisement;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DetailController;
use App\Models\ClassCategory;
use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobStreet extends Controller
{
    public function index(){
        $data['data']           = Advertisement::AdvText();
        $data['meta']           = DetailController::metaData("Info Loker", "Loker", "Pilihan loker yang tersedia dan bisa dilamar", null, null);
        $data['categories']     = ClassCategory::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        $data['cart_count']     = isset(auth()->user()->id) ? Cart::where('user_id', auth()->user()->id)->where('status', 1)->count() : null;


        $api = 'https://loker-api.vercel.app/api/job';
        $data['jobs'] = Http::get($api)['data']['jobs']['jobs'];

        // dd($data);
        return view('member.jobs.index', ['data' => $data]);

    }

    public function show(Request $request){
        $api = 'https://loker-api.vercel.app/api/job';
        $response = Http::get($api)['data']['jobs'];
        $q = array_search("categories",$response);
        dd($q);
    }
}
