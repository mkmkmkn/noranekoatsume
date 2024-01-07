<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $inputs = request()->validate([
            'comment' => 'required|max:255'
        ]);

        $comment = Comment::create([
            'comment' => $inputs['comment'],
            'user_id' => auth()->user()->id,
            'catimage_id' => $request->catimage_id,
        ]);

        return back()->with('message','コメントを投稿しました');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
        }
        return redirect()->route('dashboard')->with('message','コメントを削除しました');
    }
}
