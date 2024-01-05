<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Catimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Nice;
use App\Models\Comment;

class AlbumController extends Controller
{
    public function index()
    {
        $catImages = Catimage::with('nices','comments')->orderBy('id','desc')->paginate(9);
        $niceGet = Catimage::with('nices')->orderBy('id','desc')->paginate(9);

        $nices = array();
        foreach ($niceGet as $catImage) {
            $imageNiceShow = Nice::where('catimage_id', $catImage->id)->where('user_id', auth()->user()->id)->first();

            if ($imageNiceShow) {
                $nices[] = true;
            } else {
                $nices[] = false;
            }
        }

        return view('album', compact('catImages', 'nices'));
    }
}
