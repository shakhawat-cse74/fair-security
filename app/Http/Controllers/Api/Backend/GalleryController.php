<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Traits\ApiResponse;

class GalleryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $galleries = Gallery::where('status', 1)->get()->map(function ($gallery) {
                $images = json_decode($gallery->image, true);
                if (is_array($images) && count($images) > 0) {
                    $gallery->image = array_map(function($img) {
                        return asset($img);
                    }, $images);
                } else {
                    $gallery->image = [asset('admin/assets/images/default.png')];
                }
                return $gallery;
            });
            return $this->successResponse($galleries, 'Galleries retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve galleries.', 500);
        }
    }
}
