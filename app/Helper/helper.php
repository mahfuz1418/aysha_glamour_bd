<?php

use Intervention\Image\Facades\Image;

if (!file_exists('uploadPlease')) {
    function uploadPlease($image)
    {
        $imageName = hexdec(uniqid()).'-'.$image->getClientOriginalName();
        Image::make($image)->save('uploads/' . $imageName);
        return $image = 'uploads/' . $imageName;
    }
}

