<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function resetPassword(){
        // dd('helo');
        return view('member.profile.setting.reset-password');
    }

    public function updatePassword(Request $request){
        $user = User::where('id', auth()->user()->id)->first();
        // dd($user);
        if($request->passwordConform != $request->password){
            return back()->with('msg', 'Konfirmasi password tidak sesuai...');
        }else{
            if(Hash::check($request->passwordNow, $user->password)){
                $save = User::findOrFail($user->id);
                $save->password = Hash::make($request->password);
                $save->save();

                return redirect('/learning/dashboard/'.$user->id)->with('msg', 'Password berhasil diupdate...');
            }else{
                return back()->with('msg', 'Password sebelumnya tidak sesuai...');
            }
        }
    }

    public function defaultPassword($user_id){
        $user = User::where('id', $user_id)->update([
            'password' => Hash::make('12345678'),
        ]);

        Alert::success('Berhasil', 'Password berhasil direset ke default 12345678');
        return back();
    }
}
