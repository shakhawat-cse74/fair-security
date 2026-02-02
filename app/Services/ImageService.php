<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ImageService
{
    public function uploadImage($imageFile, $directory, $width = null, $height = null)
    {
        $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
        $imagePath = $directory . '/' . $imageName;

        // Resize and save the image (v3 syntax)
        $image = Image::read($imageFile);
        
        if ($width || $height) {
            $image->scaleDown(width: $width, height: $height);
        }

        $extension = $imageFile->getClientOriginalExtension();
        $encoded = $image->encodeByExtension($extension);

        $fullPath = public_path($imagePath);
        $dir = dirname($fullPath);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($fullPath, $encoded);

        return $imagePath;
    }

    public function deleteImage($imagePath)
    {
        if ($imagePath) {
            $fullPath = public_path($imagePath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
