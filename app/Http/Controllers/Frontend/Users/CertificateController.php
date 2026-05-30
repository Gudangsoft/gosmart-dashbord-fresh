<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Certificate;
use App\Models\User;
use App\Models\ClassMenu;
use App\Model\LogoMitra;

class CertificateController extends Controller
{
    public static function GenerateCertificate($user_id, $class_id){
        $check = Certificate::where('class_id', $class_id)
                ->where('user_id', $user_id)
                ->where('status', 'p')
                ->first();

        if($check){
            $row        = User::where('id', $user_id)->first();
            $row_class  = ClassMenu::where('class_id', $class_id)->first();

            $nama = $row->name;
            $date = $check->created_at;
            $class_name = strtoupper($check->getClass->name);
            $code = '#'.$check->code;

            if (empty($nama)) {
                $gambar = "/public/img/certificate/1.jpg";
            }else {
                $gambar = "public/img/certificate/certificate.png";
            }
            $image = imagecreatefrompng($gambar);
            $white = imageColorAllocate($image, 255, 255, 255);
            $black = imageColorAllocate($image, 0, 0, 0);
            $black = imageColorAllocate($image, 55, 55, 55);
            $font = "public/img/certificate/QuinchoScript_PersonalUse.ttf";
            $font_desc = "public/img/certificate/Inter-Medium.ttf";
            $size = 150;

            //definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
            $image_width = imagesx($image);

            //membuat textbox agar text centered
            $text_box = imagettfbbox($size,0,$font,$nama);
            $text_width = $text_box[2]-$text_box[0]; // lower right corner - lower left corner
            $text_height = $text_box[3]-$text_box[1];
            $x = ($image_width/2) - ($text_width/2);

            $text_box3 = imagettfbbox(55,0,$font,$class_name);
            $text_width3 = $text_box3[2]-$text_box3[0]; // lower right corner - lower left corner
            $text_height3 = $text_box3[3]-$text_box3[1];
            $x3 = ($image_width/2) - ($text_width3/2);

            //generate sertifikat beserta namanya
            imagettftext($image, $size, 0, $x, 1500, $black, $font, $nama);
            imagettftext($image, 60, 0, $x3, 1950, $black, $font_desc, $class_name);
            imagettftext($image, 40, 0, 190, 150, $black, $font_desc, $code);

            $save = "public/img/certificate/".$row->name."-".$row->id."-".$check->code.".png";
            header('Content-type: image/png');
            imagepng($image, $save);
            imagedestroy($image);
            return redirect('/certificate_print/'.$user_id.'/'.$class_id);

        }else{
            dd('not found');
        }

    }

    public static function PrintCertificate($user_id, $class_id){
        $data = array();
        $row        = User::where('id', $user_id)->first();
        $row_class  = ClassMenu::where('class_id', $class_id)->first();
        $s_mentor   = User::where('id', $row_class->add_by)->first();

        $detail_certificate = Certificate::where('user_id', auth()->user()->id)
                ->where('class_id', $class_id)
                ->where('status', 'p')
                ->first();

        $data['code'] = QrCode::size(500)
                        ->format('png')
                        ->color(47,56,126, 65)
                        ->generate($detail_certificate->code, public_path('img/certificate/code/'.$detail_certificate->code.'.png'));

        $data['background'] = "public/img/certificate/".$row->name."-".$row->id."-".$detail_certificate->code.".png";
        $data['image_certificate'] = "img/certificate/class/".$row->name."-".$row->id."-".$detail_certificate->code.".png";
        
        
        if(file_exists(public_path()."/".$data['image_certificate'])){
            $data['image'] = 'public/'.$data['image_certificate'];
        }else{
            $data['image'] = '';
        }
        // dd($data['image']);
        
        $data['name'] = $detail_certificate->getUser->name;
        $data['class'] = strtoupper($detail_certificate->getClass->name);
        $data['mentor_name'] = $row_class->getUser->name;
        $data['director'] = config('app.director');;
        $data['date'] = Carbon::createFromFormat('Y-m-d H:i:s', $detail_certificate->created_at)->format('D, d M Y');
        
        $logo = LogoMitra::where('add_by', $row_class->add_by)->where('class_id', $class_id)->value('url_image');
        if($logo == null){
            $logo = 'public/img/certificate/logo/default.png';
        }

        $signature_ceo = 'public/img/certificate/signature/director.png'; //primary
        $signature_mentor = 'public/'.$s_mentor->userData->signature_url;
        // dd($signature_mentor);
        
        if($signature_mentor == null){
            $signature_mentor = 'public/img/certificate/signature/default.png';
        }

        if (empty($data['background'])) {
            $gambar = "/public/img/certificate/1.jpg";
        }else {
            $gambar = "public/img/certificate/".auth()->user()->name."-".auth()->user()->id."-".$detail_certificate->code.".png";
        }

        $image                  = imagecreatefrompng($gambar);
        $color                  = imagecolorallocate($image, 22, 25, 25);
        $image_logo             = imagecreatefrompng($logo);
        $image_signature_ceo    = imagecreatefrompng($signature_ceo);
        $image_signature_mentor = imagecreatefrompng($signature_mentor);
        $qrcode                 = imagecreatefrompng(public_path('img/certificate/code/'.$detail_certificate->code.'.png'));

        list($width_qrcode, $height_qrcode) = getimagesize(public_path('img/certificate/code/'.$detail_certificate->code.'.png'));
        $newwidth_qrcode = $width_qrcode * 0.8;
        $newheight_qrcode = $height_qrcode * 0.8;
        
        list($width, $height) = getimagesize($logo);
        $newwidth = $width * 0.3;
        $newheight = $height * 0.3;

        list($width_s, $height_s) = getimagesize($signature_ceo);
        $newwidth_s = $width_s * 0.3;
        $newheight_s = $height_s * 0.3;

        list($width_mentor, $height_mentor) = getimagesize($signature_mentor);
        $newwidth_mentor = $width_mentor * 0.3;
        $newheight_mentor = $height_mentor * 0.3;

        // Signature name
        $font_desc = "public/img/certificate/Inter-Medium.ttf";
        imagettftext($image, 40, 0, 1950, 2250, $color, $font_desc, $data['mentor_name']);
        imagettftext($image, 40, 0, 1380, 2250, $color, $font_desc, $data['director']);
        imagettftext($image, 30, 0, 1630, 2550, $color, $font_desc, $data['date']);

        // Resize
        
        imagecopyresized($image, $image_logo, 800, 130, 0, 0, $newwidth, $newheight, $width, $height);
        imagecopyresized($image, $image_signature_ceo, 1400, 2100, 0, 0, $newwidth_s, $newheight_s, $width_s, $height_s);
        imagecopyresized($image, $image_signature_mentor, 1900, 2100, 0, 0, $newwidth_mentor, $newheight_mentor, $width_mentor, $height_mentor);
        imagecopyresized($image, $qrcode, 400, 800, 0, 0, $newwidth_qrcode, $newheight_qrcode, $width_qrcode, $height_qrcode);


        $save = "public/img/certificate/class/".$row->name."-".$row->id."-".$detail_certificate->code.".png";
        header('Content-type: image/png');
        imagepng($image, $save);
        imagedestroy($image);
        // return redirect('/certificate_print/'.$user_id.'/'.$class_id);

        return view('member.dashboard.certificate.detail', compact('data'));
    }
    
    public function download($code){
        $data = array();
        $row = Certificate::where('code', $code)
                ->where('status', 'p')
                ->first();

        $data['class'] = strtoupper($row->getClass->name);
        $data['code'] = $row->code;
        $data['url'] = '/certificate/'.$row->user_id.'/'.$row->class_id;
        $data['url_download'] = '/img/certificate/class/'.$row->getUser->name.'-'.$row->user_id.'-'.$row->code.".png";
        if(empty($row->getClass->image)){
            $image = '/home-images/kelas/thumbnail/default.jpg';
        }else{
            $image = '/home-images/kelas/thumbnail/'.$row->getClass->image;
        }
        $data['image'] = $image;

        $pdf = Pdf::loadView('member.dashboard.certificate.pdfdownload', compact('data'));

        return $pdf->setPaper('a4', 'landscape')->download($row->getClass->name.'-'.$row->getUser->name.'-'.$row->user_id.'-'.$row->code.'certificate.pdf');
    }
}
