<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'user_name' => $user->name,
            'user_email' => $user->email,
            'avatar' => $user->avatar,
            'pro_username' => $user->pro_username,
            'pro_server' => $user->pro_server,
        ];
        return view('user.my-account', $data);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        
        //delete old image and load new one to model
        if ($request->avatar) {
            $imageName = $request->avatar->getClientOriginalName();
            $parsedUrl = parse_url($user->avatar);
            $path = public_path($parsedUrl['path']);
            if (File::exists($path)) {
                File::delete($path);
            }
            $user->avatar = asset($this->storeBase64($request->image_base64, $imageName));
        }

        //load infomations to model then save
        $user->name = $request->name;
        $user->email = $request->email;
        $user->pro_username = $request->pro_username;
        $user->pro_server = $request->pro_server;
        $user->save();

        return back()->with('success', 'Image uploaded successfully.');
    }

    private function storeBase64($imageBase64, $imageName)
    {
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64)      = explode(',', $imageBase64);
        $imageBase64 = base64_decode($imageBase64);
        $imageName= time().'_'.$imageName;
        $directory = public_path('images/avatars');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true, true);
        }
        
        $path = public_path() . "/images/avatars/" . $imageName;

        file_put_contents($path, $imageBase64);

        $imageSource = 'images/avatars/' . $imageName;
        return $imageSource;
    }
}
