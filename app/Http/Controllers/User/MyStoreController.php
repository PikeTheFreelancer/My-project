<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyStoreController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $merchandises = Merchandise::where('user_id',$user_id)->get();
        $data = ['merchandises' => $merchandises];

        return view('user.my-store', $data);
    }

    public function save(Request $request)
    {
        $merchandise = new Merchandise;
        $user_id = Auth::user()->id;

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $imagePath = asset('images/' . $imageName);
        $merchandise->name = $request->name;
        $merchandise->image = $imagePath;
        $merchandise->description = $request->description;
        $merchandise->price = $request->price;
        $merchandise->user_id = $user_id;

        $merchandise->save();
        return redirect()->route('user.my-store');
    }
}
