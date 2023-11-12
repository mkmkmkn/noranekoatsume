<?php

namespace App\Http\Controllers;

use App\Models\Catimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatimageController extends Controller
{
    public function create()
    {
        $imageFiles = Storage::files('public/catimages');;
        return view('create', ['imageFiles' => $imageFiles]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();
    
        // $request->image->move(public_path('catimages'), $imageName);

        // storageへ保存先変更　ここから
        if (!file_exists($catimages_dir = storage_path('app/public/catimages'))) {
            mkdir($catimages_dir, 0777, true);
        }
        // $image = base64_decode($request->image_base64_text);
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
        $imageName = $catimage->image;


        Storage::disk('public')->delete('images/' . $item->image);


        $catimage->delete();
        // 削除する画像のパスを生成
        $filePath = 'public/catimages/' . $imageName;

        // ファイルが存在するか確認
        if (Storage::exists($filePath)) {
            // ファイルを削除
            Storage::delete($filePath);

            // 他に必要な処理があればここで実行

            return redirect()->with('success', '画像が削除されました。');
        }

        return redirect()->with('error', '指定された画像は存在しません。');
    }
}
