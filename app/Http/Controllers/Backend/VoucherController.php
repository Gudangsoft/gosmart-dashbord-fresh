<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;

class VoucherController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $class_id       = $request->class_id;
        $total          = $request->voucher_total;
        $discount       = $request->discount;
        $expired        = $request->expired;

        for ($i=0; $i < $total; $i++) {
            # code...
            try {
                $save[$i]               = new Voucher();
                $save[$i]->code         = Str::random('10');
                $save[$i]->class_id     = $class_id;
                $save[$i]->status       = 1;
                $save[$i]->discount     = $discount;
                $save[$i]->created_at   = auth()->user()->id;
                $save[$i]->expired_at   = $expired;
                $save[$i]->save();
            } catch (Exception $e) {
                Alert::error('Failed', $e->getMessage());
                return back()->with('voucher', 'voucher');
            }
        }

        Alert::success('Berhasil', 'Voucher berhasil ditambahkan');
        return back()->with('voucher', 'voucher');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        // dd($request);
        try {
            $save = Voucher::findOrFail($request->id);
            $save->discount = $request->discount;
            $save->save();
        } catch (Exception $e) {
            Alert::error('Gagal', $e->getMessage());
            return back();
        }

        Alert::success('Berhasil', 'Data berhasil diubah');
        return back();
    }

    public function destroy($id)
    {
        try {
            Voucher::where('id', $id)->delete();
        } catch (Exception $e) {
            Alert::error('Gagal', $e->getMessage());
            return back();
        }

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return back();

    }

    public function custom(Request $request)
    {
        // dd($request);
        $class_id       = $request->class_id;
        $code           = $request->voucher_code;
        $discount       = $request->discount;
        $expired        = $request->expired;

        $validator = Validator::make($request->all(), [
            'voucher_code' => 'required|unique:vouchers,code',
        ]);

        if($validator->fails()){
            Alert::error('Failed', 'Kode voucher sudah terdaftar, silakan coba lagi');
            return back()->with('voucher', 'voucher');
        }else{
            try {
                $save               = new Voucher();
                $save->code         = $code;
                $save->class_id     = $class_id;
                $save->status       = 1;
                $save->discount     = $discount;
                $save->created_at   = auth()->user()->id;
                if($expired == null) {
                    $date = Carbon::now();
                    $add_year = $date->addYear(1);
                    $save->expired_at   = $add_year;
                }else{
                    $save->expired_at   = $expired;
                }
                $save->save();
            } catch (Exception $e) {
                Alert::error('Failed', $e->getMessage());
                return back()->with('voucher', 'voucher');

            }

            Alert::success('Berhasil', 'Voucher berhasil ditambahkan');
            return back()->with('voucher', 'voucher');
        }
    }
}
