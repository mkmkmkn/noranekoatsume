<?php

namespace App\Http\Controllers;

use App\Models\Catimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatimageUploadController extends Controller
{
    public function index()
    {
        return view('catimage_upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();
        $id = auth()->id();
        // 'user' => $request->user(),

        // storageへ保存先変更　ここから
        if (!file_exists($catimages_dir = storage_path('app/public/catimages'))) {
            mkdir($catimages_dir, 0777, true);
        }
        $image = $request->file('image');
        Storage::put('public/catimages/'.$imageName,  file_get_contents($image));
        // storageへ保存先変更　ここまで

        Catimage::create([
            'title' => $request->title,
            'image_path' => $imageName,
            'text' => $request->text,
            'user_id' => $id,
            'map_lat' => $request->map_lat,
            'map_lng' => $request->map_lng,
        ]);
    
        return redirect()->route('catimage_upload')->with('message', '画像を投稿しました。');
    }
}
