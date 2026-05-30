<?php

namespace App\Http\Controllers;

use App\Models\WithdrawModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile            = DashboardController::userData(auth()->user()->id);
        $data['income']     = AdminController::dataDashboard('total_income');
        $data['data']       = WithdrawModel::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        // dd($data);
        return view('backend.withdraw.index', compact(
            'profile',
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->withdraw > $request->saldo || $request->withdraw == 0 || $request->withdraw < 100000){
            Alert::error('Error', 'Permintaan tidak memenuhi syarat');
            return redirect()->route('withdraw.index');
        }else{
            try {
                $save = new WithdrawModel();
                $save->user_id = auth()->user()->id;
                $save->withdraw_total = (int)$request->withdraw;
                $save->description = $request->description_withdraw;
                $save->status = 1;
                $save->save();

                Alert::success('Sukses', 'Permintaan berhasil dikirim');
                return redirect()->route('withdraw.index');
            } catch(Exception $error){
                return redirect()->route('withdraw.index')->with('message', $error->getMessage());
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
