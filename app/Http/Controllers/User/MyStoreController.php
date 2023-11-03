<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        if ($request->image) {
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = asset('images/' . $imageName);
            
            $merchandise->image = $imagePath;
        }
        $merchandise->name = $request->name;
        $merchandise->description = $request->description;

        $merchandise->price = (float)str_replace('.', '', $request->price);
        $merchandise->user_id = $user_id;

        $merchandise->save();
        return redirect()->route('user.my-store');
    }

    public function getMerchandiseFields(Request $request)
    {
        $merchandise_id = $request->input('merchandise_id');
        $item = Merchandise::find($merchandise_id);
        // return view('layouts.edit-merchandise', ['item' => $item]);
        return response()->json($item);
    }

    public function saveMerchandiseFields(Request $request)
    {
        $merchandise_id = $request->merchandise_id;
        $merchandise = Merchandise::find($merchandise_id);

        //check if image is changed
        if ($request->image) {

            //delete old one
            $parsedUrl = parse_url($merchandise->image);
            $path = public_path($parsedUrl['path']);
            if (File::exists($path)) {
                File::delete($path);
            }

            //create new one
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $imagePath = asset('images/' . $imageName);

            $merchandise->image = $imagePath;
        }

        $merchandise->name = $request->name;
        $merchandise->description = $request->description;
        $merchandise->price = $request->price;

        $merchandise->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $merchandise_id = $request->input('merchandise_id');
        $merchandise = Merchandise::find($merchandise_id);

        //clear image
        $parsedUrl = parse_url($merchandise->image);
        $path = public_path($parsedUrl['path']);
        if (File::exists($path)) {
            File::delete($path);
        }

        $merchandise->delete();
        $merchandise->comment()->delete();

        return response()->json('deleted item');
    }
}
