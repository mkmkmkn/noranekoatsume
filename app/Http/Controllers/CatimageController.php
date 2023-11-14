<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Catimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatimageController extends Controller
{
    public function create()
    {
        $catImages = DB::table('catimages')->get()->toArray();
        $imageFiles = Storage::files('public/catimages');;
        return view('create', ['imageFiles' => $imageFiles, 'catImages' => $catImages]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();

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
        ]);
    
        return redirect()->route('create.form')->with('success', 'Image uploaded successfully');
    }
    
    public function destroy($id)
    {
        $catimage = Catimage::find($id);
        $imageName = $catimage->image_path;

        // ファイルが存在するか確認
        // if (Storage::exists($imageName)) {
            Storage::disk('public')->delete('catimages/' . $imageName);
            $catimage->delete();
        // }

        $catImages = DB::table('catimages')->get()->toArray();
        $imageFiles = Storage::files('public/catimages');;
        return view('create', ['imageFiles' => $imageFiles, 'catImages' => $catImages]);
    }
}
