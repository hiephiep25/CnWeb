<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(8);

        return view('dashboard', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('blog-detail', compact('blog'));
    }
}
