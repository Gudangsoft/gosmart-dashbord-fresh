<?php
namespace App
;

use Carbon\Carbon;

class ResizeImage{

    public static function resizeImage($path, $name){
        $filename = $path;
        $dateTime = date('Y-m-d H:i:s');
        $updatedDateFormat =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('mdYHis');

        // Get new sizes
        list($width, $height, $type) = getimagesize($filename);
        $newwidth = $width;
        $newheight = $height;

        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);

        if($type == IMAGETYPE_PNG){
            $format_image = '.png';
        }else if($type == IMAGETYPE_JPEG){
            $format_image = '.jpg';
        }
        // Resize
        $save_name = $updatedDateFormat.auth()->user()->id.$name.$format_image;
        $thumbnail_save = 'home-images/kelas/thumbnail/'.$updatedDateFormat.auth()->user()->id.$name.'.png';
        imagecopyresized($thumb, $source, 0, 0, 0, 0, 400, 400, $width, $height);

        // Output
        imagejpeg($thumb, $thumbnail_save);
        return ['file_name' => $save_name ];

    }

}
