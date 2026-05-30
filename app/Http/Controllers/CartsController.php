<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ClassMenu;
use App\Models\ClassRequest;
use App\Models\Order;
use App\Models\Voucher;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class CartsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return redirect('/learning/tab-menu/cart');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $check      = Cart::where('class_id', $request->class_id)->where('user_id', auth()->user()->id)->first();
        $message    = '';
        $count      = '';
        $status      = '';

        if(empty($check)){
            $message    = 'Kelas berhasil ditambahkan';
            $status     = true;
            $save = Cart::create([
                'class_id'  => $request->class_id,
                'price'  => $request->price,
                'user_id'   => auth()->user()->id,
                'status'    => 1,
            ]);

            if($save){
                $count  = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();
            }
        }else{
            $message    = 'Kelas sudah dipilih';
            $status     = false;
        }

        return response()->json(
            [
                'success'   => $status,
                'message'   => $message,
                'count'     => $count
            ]
        );
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
        //
    }

    public function destroy($id)
    {
        //
    }

    public function order(Request $request){
        // dd($request);
        $data['user']           = User::findOrfail($request->user_id);
        $data['cart']           = self::CartData($data['user']->id);

        // dd($data);
        return view('member.orders.index', [
            'data' => $data,
            'status' => 9999,
            'discount' => null,
            'voucher' => null,
            'total' => $data['cart']['price_total']
        ]);
    }

    public function orderPage(){
        $data['user']           = User::findOrfail(auth()->user()->id);
        $data['cart']           = self::CartData($data['user']->id);

        // dd($data);
        return view('member.orders.index', [
            'data' => $data,
            'status' => 9999,
            'discount' => null,
            'voucher' => null,
            'total' => $data['cart']['price_total']
        ]);
    }

    public function redeem(Request $request){
        $data['user']           = User::findOrfail(auth()->user()->id);
        $data['cart']           = self::CartData($data['user']->id);

        $voucher        = Voucher::where('code', $request->code_voucher)->first();
        $class_check    = Cart::where('class_id', $voucher->class_id)->where('user_id', $data['user']->id)->first();

        dd($class_check);
        if($voucher->status == 2) {
            return view('member.orders.index', [
                'data' => $data,
                'status' => 2,
                'voucher' => $voucher,
                'discount' => null,
                'total' => null
            ]);
        }else{
            if($voucher->expired_at < Carbon::now()){
                return view('member.orders.index', [
                    'data' => $data,
                    'status' => 0,
                    'voucher' => $voucher,
                    'discount' => null,
                    'total' => null
                ]);
            }else{
                $discount = $class_check->price - $voucher->discount;
                $total = Cart::where('user_id', auth()->user()->id)->sum('price');

                $update = Cart::where('class_id', $voucher->class_id)->update([
                    'price' => $discount,
                ]);

                if($update){
                    $update_voucher = Voucher::where('code', $request->code_voucher)->update([
                        'status' => 2,
                        'used_by' => auth()->user()->id,
                    ]);

                }
                Alert::success('Berhasil', 'Voucher diskon '.$voucher->discount.' kelas '.Str::title($voucher->getClass->name).' berhasil ditambahkan');
                return redirect('order');
            }
        }

    }

    public function checkout(Request $request){

        $user       = User::where('id', auth()->user()->id)->whereNotNull('email_verified_at')->first();
        $data_count = ClassMenu::whereIn('class_id', $request->class_list)->get()->count();
        $data_class = Cart::whereIn('class_id', $request->class_list)->get();


        $snap_token = $request->snap_token;

        if (empty($snap_token)) {

            $midtrans   = new CreateSnapTokenService($user, $data_class);
            $snapToken  = $midtrans->getSnapToken();

            foreach ($data_class as $k => $v) {

                $order[$k]              = new Order();
                $order[$k]->number      = $v->class_id;
                $order[$k]->total_price = $v->discount ? $v->price - ($v->discount/100*$v->price) : $v->price;
                $order[$k]->snap_token  = $snapToken;
                $order[$k]->save();

                $validasi1 = ClassRequest::where('class_id', $v->class_id)
                                            ->where('member_id', $user->id)
                                            ->where('premium', true)
                                            ->first();

                $validasi2 = ClassRequest::where('class_id', $v->class_id)
                                            ->where('member_id', $user->id)
                                            ->first();

                $alert = 'alertPay';

                if(!empty($validasi1)){
                    return redirect('/learning/class_list')->with('msg', 'kelas sudah diambil');
                }else if(!empty($validasi2)){
                    return redirect('/learning/pay_status/'.$v->class_id.'')->with('msg-notpay', '');
                }else{
                    $validate[$k]               = new ClassRequest;
                    $validate[$k]->member_id    = $user->id;
                    $validate[$k]->class_id     = $v->class_id;
                    $validate[$k]->pay_image    = null;
                    $validate[$k]->status       = 'p';
                    $validate[$k]->premium      = false;
                    $validate[$k]->save();

                    $delete[$k] = Cart::where('class_id', $v->class_id)->update([
                        'status' => 2
                    ]);
                }

            }
        }

        return view('member.orders.show', compact('snapToken', 'data_class'));


    }

    public function cancel($id){
        Cart::where('class_id', $id)->where('user_id', auth()->user()->id)->delete();
        return back();
    }

    public function voucherCode(Request $request){

        $voucher      = Voucher::where('code', $request->code_voucher)->where('status', 1)->first();
        $class_check   = Cart::where('class_id', $voucher->class_id)->first();
        $class_id   = '';
        $discount   = '';
        $message    = '';
        $status     = '';
        $status     = '';

        if(empty($voucher)){
            $message    = 'Voucher tidak tersedia';
            $status     = false;

        }else{
            if(empty($class_check)){
                $message    = 'Voucher tidak dapat digunakan untuk kelas saat ini';
            }else{
                $message    = 'Voucher diskon '.$voucher->discount.' kelas '.Str::title($voucher->getClass->name).' berhasil ditambahkan';
                $status     = true;
                $class_id   = $voucher->class_id;
                $discount   = $voucher->discount;
            }

        }

        return response()->json(
            [
                'success'   => $status,
                'message'   => $message,
                'classid'   => $class_id,
                'discount'  => $discount,
            ]
        );
    }

    public function reorder($cid){
        $class = ClassMenu::where('class_id', $cid)->first();
        $price = isset($class->discount) ? ($class->price - $class->discount/100*$class->price) : $class->price;

        // hapus request kelas
        ClassRequest::where('class_id', $cid)->where('member_id', auth()->user()->id)->delete();

        // cek orderan
        $check = Cart::where('class_id', $cid)->where('user_id', auth()->user()->id)->count();
        if($check == 0){
            $save = Cart::create([
                'class_id'  => $cid,
                'price'     => $price,
                'user_id'   => auth()->user()->id,
                'status'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }else{
            $save = Cart::where('class_id', $cid)->where('user_id', auth()->user()->id)->update([
                'class_id'  => $cid,
                'price'     => $price,
                'user_id'   => auth()->user()->id,
                'status'    => 1,
                'updated_at' => Carbon::now(),
            ]);

        }

        return redirect()->route('carts.index');
    }


    public static function CartData($user_id){
        $rows = Cart::where('user_id', $user_id)->where('status', 1)->get();
        $data['price_total'] = 0;

        if(isset($rows)){
            foreach($rows as $k=>$v){
                $data['data'][$k]['class_id']       = $v->class_id;
                $data['data'][$k]['data_class']     = DetailController::classDetail($v->class_id);

                $data['data'][$k]['total_discount']     = $v->getClass->discount;
                $data['data'][$k]['price']              = $v->price;
                // $data['data'][$k]['price']              = isset($v->getClass->discount) ? $v->getClass->price - ($v->getClass->discount/100*$v->getClass->price) : $v->getClass->price;

                $data['price_total']                    =  Cart::where('user_id', auth()->user()->id)->where('status', 1)->sum('price');
            }
        }
        // dd($data);
        return $data;

    }
}
