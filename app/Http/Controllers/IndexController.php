<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Post;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function setting()
    {
        return Setting::first();
    }

    public function index()
    {
        $setting = $this->setting();
        $posts = Post::where('status', 1)->orderBy('published_at', 'DESC')->limit(3)->get();
        return view('welcome', compact('setting', 'posts'));
    }

    public function blog()
    {
        $setting = $this->setting();
        $posts = Post::where('status', 1)->orderBy('published_at', 'DESC')->paginate(4);
        return view('blog', compact('setting', 'posts'));
    }

    public function blogCategory($slug)
    {
        $setting = $this->setting();
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->where('status', 1)->orderBy('published_at', 'DESC')->paginate(4);
        return view('blog', compact('setting', 'posts'));
    }

    public function blogSearch(Request $request)
    {
        $setting = $this->setting();
        $posts = Post::search($request->get('q'))->where('status', 1)->orderBy('published_at', 'DESC')->paginate(4);
        return view('blog', compact('posts', 'setting'));
    }

    public function show($slug)
    {
        $setting = $this->setting();
        $post = Post::where('slug', $slug)->first();

        $prev = Post::where('id', '<', $post->id)
                ->latest('id')
                ->first();

        $next = Post::where('id', '>', $post->id)
                ->first();

        return view('show', compact('setting', 'post', 'prev', 'next'));
    }

    public function comment(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'body' => 'required|min:5'
        ]);

        $post = Post::where('slug', $slug)->first();

        $request['post_id'] = $post->id;
        $request['status'] = 0;
        Comment::create($request->all());

        // return redirect('/blog/' . $slug);
        return redirect()->back();

    }
}
