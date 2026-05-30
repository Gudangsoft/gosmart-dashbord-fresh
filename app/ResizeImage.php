<?php
/*
    Created by Jarwonozt
    References for php.net
*/
namespace App;

use Carbon\Carbon;

class ResizeImage{

    public static function resizeImage($path, $name, $folder_first, $folder_second){
        $filename = $path;
        $dateTime = date('Y-m-d H:i:s');
        $updatedDateFormat =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->format('mdYHis');
        // dd($folder_first);
        $extension_image = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if($extension_image == 'jpg' || $extension_image == 'jpeg'){
            $im = imagecreatefromjpeg($folder_first.$path);
            $format_image = '.jpg';
        }else if($extension_image == 'png'){
            $im = imagecreatefrompng($folder_first.$path);
            $format_image = '.png';
        }
        $f_open = $folder_first.$path;

        // Get new sizes
        list($width, $height) = getimagesize($f_open);
        $newwidth = 400;
        $newheight = 400;

        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        // $source = imagecreatefromjpeg($filename);

        // Resize
        $save_name = $updatedDateFormat.auth()->user()->id.$name.$format_image;
        $thumbnail_save = $folder_second.$updatedDateFormat.auth()->user()->id.$name.$format_image;
        imagecopyresized($thumb, $im, 0, 0, 0, 0, 400, 400, $width, $height);

        // Output
        imagejpeg($thumb, $thumbnail_save);
        return ['file_name' => $save_name ];

    }

}
