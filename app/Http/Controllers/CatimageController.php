<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Catimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Nice;
use App\Models\Comment;

class CatimageController extends Controller
{
    public function index()
    {
        $catImages = Catimage::with('nices','comments')->paginate(10);
        $niceGet = Catimage::with('nices')->paginate(10);

        $nices = array();
        foreach ($niceGet as $catImage) {
            $imageNiceShow = Nice::where('catimage_id', $catImage->id)->where('user_id', auth()->user()->id)->first();

            if ($imageNiceShow) {
                $nices[] = true;
            } else {
                $nices[] = false;
            }
        }

        return view('dashboard', compact('catImages', 'nices'));
    }
    
    public function destroy($id)
    {
        $catimage = Catimage::find($id);
        $imageName = $catimage->image_path;
        $nice = Nice::where('catimage_id', $id)->delete();
        $comment = Comment::where('catimage_id', $id)->delete();

        // ファイルが存在するか確認
        if (Storage::disk('public')->exists('catimages/' . $imageName)) {
            Storage::disk('public')->delete('catimages/' . $imageName);
            $catimage->delete();
        }

        $catImages = DB::table('catimages')->get()->toArray();
        return redirect()->route('dashboard')->with('message','投稿を削除しました');
    }
}
