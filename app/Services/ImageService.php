<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ImageService
{
    public function uploadImage($imageFile, $directory, $width = null, $height = null)
    {
        try {
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
            
            // Robust directory creation
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0775, true)) {
                    \Log::error("Failed to create directory: " . $dir);
                    throw new \Exception("Could not create directory for upload.");
                }
            }

            // Check if directory is writable
            if (!is_writable($dir)) {
                \Log::error("Directory is not writable: " . $dir);
                throw new \Exception("Upload directory is not writable.");
            }

            if (file_put_contents($fullPath, $encoded) === false) {
                \Log::error("Failed to write file to: " . $fullPath);
                throw new \Exception("Failed to save the uploaded image.");
            }

            return $imagePath;
        } catch (\Exception $e) {
            \Log::error("Image Upload Error: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteImage($imagePath)
    {
        if ($imagePath && $imagePath !== 'admin/assets/images/default.png') {
            $fullPath = public_path($imagePath);
            if (file_exists($fullPath) && is_file($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
