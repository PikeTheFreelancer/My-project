<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'user_name' => $user->name,
            'user_email' => $user->email,
            'avatar' => $user->avatar,
        ];
        return view('user.my-account', $data);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        if ($request->avatar) {
            //delete old one
            $parsedUrl = parse_url($user->avatar);
            $path = public_path($parsedUrl['path']);
            if (File::exists($path)) {
                File::delete($path);
            }

            //create new one
            $imageName = time().'_'.$request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('images/avatars'), $imageName);
            $imagePath = asset('images/avatars/' . $imageName);
            
            $user->avatar = $imagePath;
            $user->save();
        }
        return redirect()->route('user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'image_base64' => 'required',
        ]);
        $user->avatar = $this->storeBase64($request->image_base64);
        $user->save();
        return back()->with('success', 'Image uploaded successfully.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    private function storeBase64($imageBase64)
    {
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64)      = explode(',', $imageBase64);
        $imageBase64 = base64_decode($imageBase64);
        $imageName= time().'.png';
        $path = public_path() . "/images/avatars/" . $imageName;
        file_put_contents($path, $imageBase64);

        $imageSource = asset('images/avatars/' . $imageName);
        return $imageSource;
    }
}
