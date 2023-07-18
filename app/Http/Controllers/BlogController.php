<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $blogs = Blog::where('author_id', $userId)->orderBy('created_at', 'desc')->paginate(5);
        return view('my-blogs', compact('blogs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
            'audio' => 'nullable|mimes:mp3',
        ]);

        // Lấy thông tin user đang đăng nhập
        $authorId = Auth::id();

        // Xử lý lưu blog
        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->author_id = $authorId;

        // Kiểm tra và lưu thumbnail nếu có
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
            $blog->thumbnail = $thumbnailPath;
        }

        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('public/audios');
            $blog->audio = $audioPath;
        }

        $blog->save();

        // Thực hiện các xử lý khác (ví dụ: chuyển hướng, thông báo thành công, ...)
        Session::flash('success', 'Blog created successfully!');
        return redirect()->route('my-blogs');
    }

    public function edit(Blog $blog)
    {
        return view('edit-blog', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
            'audio' => 'nullable|mimes:mp3',
        ]);

        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];

        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($blog->thumbnail) {
                Storage::delete($blog->thumbnail);
            }

            // Lưu ảnh mới vào storage
            $path = $request->file('thumbnail')->store('public/thumbnails');
            $blog->thumbnail = $path;
        }

        if ($request->hasFile('audio')) {
            if ($blog->audio) {
                Storage::delete($blog->audio);
            }

            $audioPath = $request->file('audio')->store('public/audios');
            $blog->audio = $audioPath;
        }

        $blog->save();
        Session::flash('success', 'Blog updates successfully!');
        return redirect()->route('my-blogs');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('my-blogs')->with('success', 'Blog deleted successfully!');
    }
}
