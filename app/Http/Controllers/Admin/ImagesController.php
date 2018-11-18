<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ImagesController extends Controller
{
    protected $_path = '/images/items/';

    public function update()
    {
        $folder = public_path() . $this->_path;
        $images = glob($folder . "*.jpg");
        foreach ($images as $image) {
//            $this->convertImage($image,500,'thumbMd');
//            $this->convertImage($image,350,'thumbSm');
        }


    }

    private function ratio($width, $newWidth)
    {
        return $newWidth / $width;
    }

    private function convertImage($imageName, $newWidth, $path)
    {
        $fileName = $imageName;
        $dist = public_path() . $this->_path . $path . "/" . basename($imageName);
        header('Content-type: image/jpg');
        list($width, $height) = getimagesize($fileName);
        $new_width = $newWidth;
        $new_height = $height * $this->ratio($width, $new_width);
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromstring(file_get_contents($fileName));
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($image_p, $dist, 100);
    }

}