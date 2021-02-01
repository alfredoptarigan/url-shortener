<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUpload
{
    public function UploadImage($data)
    {
        $image_name = Str::random(40);
        $ext = strtolower($data->getClientOriginalExtension());
        $imageFullName = $image_name . '.' . $ext;
        $upload_path = 'images/';
        $imageURL = $upload_path . $imageFullName;
        $success = $data->move($upload_path, $imageFullName);

        return $imageURL;
    }
}
