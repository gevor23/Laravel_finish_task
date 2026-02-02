<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required | string',
            'description' => 'required | string',
            'status' => 'required | in:pending,completed',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect('/posts');
    }
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();

        return view('posts', compact('posts'));
    }
    public function info()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();

        return view('view_info', compact('posts'));
    }

    public function edit(Post $post)
    {
        // security – ուրիշի post-ը չբացվի
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        return view('edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }


        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:pending,completed',
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        // Security check
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('show', compact('post'));
    }

    public function destroyAll()
    {
        Post::where('user_id', auth()->id())->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'All posts deleted successfully');
    }
}
