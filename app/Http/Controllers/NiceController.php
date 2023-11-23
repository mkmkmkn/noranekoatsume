<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catimage;
use App\Models\Nice;
use Illuminate\Support\Facades\Auth;

class NiceController extends Controller
{
    //
    public function nice(Post $post, Request $request){
        $nice=New Nice();
        $nice->catimage_id=$post->id;
        $nice->user_id=Auth::user()->id;
        $nice->save();
        return back();
    }

    public function unnice(Post $post, Request $request){
        $user=Auth::user()->id;
        $nice=Nice::where('catimage_id', $post->id)->where('user_id', $user)->first();
        $nice->delete();
        return back();
    }
}
