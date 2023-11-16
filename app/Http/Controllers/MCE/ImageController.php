<?php

namespace App\Http\Controllers\MCE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        
        $uploadPath = public_path('images/tinymce');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, $mode = 0755, true, true);
        }
        
        $img->save(public_path('images/tinymce/' . $imageName));

        return response()->json(['location' => '/images/tinymce/' . $imageName]);
    }
}
