<?php

namespace App\Http\Controllers;

use App\Models\Catimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatimageController extends Controller
{
    public function create()
    {
        return view('create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();
    
        // $request->image->move(public_path('catimages'), $imageName);
        

        // strageへ保存先変更　ここから
        if (!file_exists($pdfs_dir = storage_path('app/catimages'))) {
            mkdir($pdfs_dir, 0777, true);
        }
        $image = base64_decode($request->image_base64_text);
        Storage::put('catimages/'.$imageName, $image);
        // strageへ保存先変更　ここまで


        Catimage::create([
            'title' => $request->title,
            'image_path' => 'strage/catimages/'.$imageName,
        ]);
    
        return redirect()->route('create.form')->with('success', 'Image uploaded successfully');
    }
    
}
