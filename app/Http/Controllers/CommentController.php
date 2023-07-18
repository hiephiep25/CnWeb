<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->blog_id = $request->input('blog_id');
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->back()->with('success', 'Comment created successfully.');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id === Auth::id()) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }
    }
}
