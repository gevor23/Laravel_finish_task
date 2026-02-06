<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'image' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect('/posts');
    }
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->paginate(10);
        return view('posts', compact('posts'));
    }
    public function info()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->paginate(10);

        return view('view_info', compact('posts'));
    }

    public function edit(Post $post)
    {
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
            'image' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
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

    public function showPosts(){
        /*$users = User::with([
            'posts' => function ($query) {
                $query->latest()->take(3);
            }
        ])->get();*/
        $users = User::whereHas('posts')
            ->with('posts')
            ->paginate(10);
        return view('show_posts', compact('users'));
    }
}
