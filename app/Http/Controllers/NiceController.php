<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catimage;
use App\Models\Nice;
use Illuminate\Support\Facades\Auth;

class NiceController extends Controller
{
    public function nice(Request $request){
        $user=Auth::user()->id;
        $nice=Nice::where('catimage_id', $request->id)->where('user_id', $user)->first();

        if (!$nice) {
            $nice=New Nice();
            $nice->catimage_id=$request->id;
            $nice->user_id=Auth::user()->id;
            $nice->save();
            $ohenji = "いいねしました";
            $niced = 1;
        } else {
            $nice->delete();
            $ohenji = "いいね削除しました";
            $niced = 0;
        }

        $countNices = Nice::where('catimage_id', $request->id)->count();

        return response()->json([
            'message' => $ohenji,
            'niced' => $niced,
            'countNices' => $countNices,
        ]);
    }
}
