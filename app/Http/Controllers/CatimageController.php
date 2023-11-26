<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Catimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Nice;

class CatimageController extends Controller
{
    public function nice($post, Request $request){
        $nice=New Nice();
        $nice->catimage_id=$post;
        $nice->user_id=Auth::user()->id;
        $nice->save();
        return back();
    }
    public function unnice($post, Request $request){
        $user=Auth::user()->id;
        $nice=Nice::where('catimage_id', $post)->where('user_id', $user)->first();
        $nice->delete();
        return back();
    }
    public function create()
    {
        // $catImages = DB::table('catimages')->get()->toArray();
        // $catImages = Catimage::with('nices')->paginate(5);
        $catImages = Catimage::with('nices')->get()->toArray();

        $unco = Catimage::with('nices')->get();

        $nices = array();
        foreach ($unco as $catImage) {
            $imageNiceShow = Nice::where('catimage_id', $catImage->id)->where('user_id', auth()->user()->id)->first();

            if ($imageNiceShow) {
                $nices[] = true;
            } else {
                $nices[] = false;
            }
        }
        // $showPostId = array;


        // $imageFiles = Storage::files('public/catimages');
        // return view('create', ['imageFiles' => $imageFiles, 'catImages' => $catImages]);

        // return view('create', ['catImages' => $catImages]);
        
        // $nice=Nice::where('catimage_id', $post->id)->where('user_id', auth()->user()->id)->first();
        // $nice=Nice::get();
        // $nice=Nice::where('user_id', auth()->user()->id)->get();
        return view('create', compact('catImages', 'nices'));
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
        return view('create', ['catImages' => $catImages]);
    }
}
