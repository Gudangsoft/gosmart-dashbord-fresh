<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ClassMenu;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class CertificateController extends Controller
{
    public function index()
    {
        $certificate = Certificate::orderBy('created_at', 'desc')->get();
        $response =[
            'message' => 'Ceritifcate Kelas G-Academy',
            'data' => $certificate,
        ];

        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($code)
    {
        $quid = null;
        $qcid = null;

        $uid = User::where('name', $code)->first();
        if($uid != null){
            $quid = $uid->id;
        }
        $cid = ClassMenu::where('name', $code)->first();
        if($cid != null){
            $qcid = $cid->class_id;
        }
        // dd($uid);
        $certificate = Certificate::where('code', $code)
                                    ->orWhere('user_id',$quid)
                                    ->orWhere('class_id', $qcid)->get();


        if($certificate == null || $code == null){

            return response()->json([
                'success' => false,
                'message' => 'Sertifikat tidak ditemukan.',
                'data' => $certificate
            ], 409);
        }else{
            foreach ($certificate as $k => $v) {
                $user = [
                    'name' => $v->getUser->name,
                    'email' => $v->getUser->email,
                ];

                $class = $v->getClass;

                $data[$k]['certificate'] = [
                    'id'        => $v->id,
                    'download'  => 'https://admin.gosmart.id/certificate/download/'.$v->code,
                    'user'      => $user,
                    'class'     => $class
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Sertifikat ditemukan.',
                'data' => $data
            ], 200);
        }

    }


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
