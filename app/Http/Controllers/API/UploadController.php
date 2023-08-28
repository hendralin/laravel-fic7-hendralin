<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->has('image')) {
            $request->validate([
                'image' => 'required|mimes:jpeg,jpg,png|max:1024',
            ]);

            $image = $request->image;
            $nameFile = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('upload/images/');
            $image->move($path, $nameFile);

            return response()->json([
                'image_path' => '/upload/images' . $nameFile,
                'base_url' => url('/'),
            ]);
        }
    }

    public function uploadMultipleImage(Request $request)
    {
        if ($request->has('image')) {
            $images = $request->image;
            foreach ($images as $key => $image) {
                $nameFile = time() . $key . '.' . $image->getClientOriginalExtension();
                $path = public_path('upload/images/');
                $image->move($path, $nameFile);
            }

            return response()->json([
                'status' => 'upload successfully',
            ]);
        }
    }
}
