<?php

namespace App\Job;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageJob
{
    /**
     * @param $file
     * @param $path
     * @param false $small
     * @return mixed|void
     */
    public function upload($file,$path,$small = false)
    {
        if ($file->isValid()) {
            $fileName = $file->hashName();
            $image = Image::make($file->getRealPath());


            if(!in_array($file->getClientOriginalExtension(),['svg'])) {
                $image->resize(1900, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            Storage::put("{$path}/{$fileName}", (string)$image->encode(null, 65), 'public');

            if($small){

                if(!in_array($file->getClientOriginalExtension(),['svg'])) {
                    $image->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                Storage::put("{$path}/small_{$fileName}", (string)$image->encode(null, 65), 'public');
            }

            return $fileName;
        }
    }

    public static function getImage($fileName,$path,$small = false)
    {
        $noImage = url('/images/default.png');
        if(!Storage::hasFile("{$path}/{$fileName}")){
            if($small){
                return collect([
                    'image' => $noImage,
                    'small' => $noImage,
                ]);
            }
            return $noImage;
        }


        if($small){
            return collect([
                'image' => Storage::url("{$path}/{$fileName}"),
                'small' => Storage::url("{$path}/small_{$fileName}"),
            ]);
        }

        return Storage::url("{$path}/{$fileName}");
    }
}
